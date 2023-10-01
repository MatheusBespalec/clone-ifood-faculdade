<?php

namespace App\Livewire;

use Illuminate\Session\SessionManager;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Attributes\On;

class Cart extends Component
{
    public $items = [];
    public float $total;
    public int $totalItems;
    public string $restaurantName;
    const MINIMUM_QUANTITY = 1;
    const DEFAULT_INSTANCE = 'shopping-cart';

    protected SessionManager $sessionManager;
    public function render()
    {
        return view('livewire.cart');
    }

    public function __construct()
    {
        $this->sessionManager = app('session');
        $this->updateCart();
    }

    public function getContent(): Collection
    {
        return $this->sessionManager->has(self::DEFAULT_INSTANCE)
            ? $this->sessionManager->get(self::DEFAULT_INSTANCE)
            : collect();
    }

    #[On('add-to-cart')]
    public function add($product): void
    {
        $cartItem = $this->createCartItem($product["id"], $product["name"], $product["price"], $product["restaurant_id"], $product["restaurant_name"]);

        $content = $this->getContent();

        if ($content->first()?->get("restaurant_id") != $product["restaurant_id"]) {
            $this->clear();
            $content = $this->getContent();
        }

        if ($content->has($product["id"])) {
            $cartItem->put('quantity', $content->get($product["id"])->get('quantity') + 1);
        }

        $content->put($product["id"], $cartItem);

        $this->sessionManager->put(self::DEFAULT_INSTANCE, $content);
        $this->updateCart();
    }

    public function update(string $id, string $action): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $cartItem = $content->get($id);

            switch ($action) {
                case 'plus':
                    $cartItem->put('quantity', $content->get($id)->get('quantity') + 1);
                    break;
                case 'minus':
                    $updatedQuantity = $content->get($id)->get('quantity') - 1;

                    if ($updatedQuantity < self::MINIMUM_QUANTITY) {
                        $updatedQuantity = self::MINIMUM_QUANTITY;
                    }

                    $cartItem->put('quantity', $updatedQuantity);
                    break;
            }

            $content->put($id, $cartItem);

            $this->sessionManager->put(self::DEFAULT_INSTANCE, $content);
        }
        $this->updateCart();
    }

    public function remove(string $id): void
    {
        $content = $this->getContent();

        if ($content->has($id)) {
            $this->sessionManager->put(self::DEFAULT_INSTANCE, $content->except($id));
        }
        $this->updateCart();
    }

    public function total(): float
    {
        $content = $this->getContent();

        $total = $content->reduce(function ($total, $item) {
            return $total + ($item->get('price') * $item->get('quantity'));
        });

        return $total ?? 0;
    }

    public function clear(): void
    {
        $this->sessionManager->forget(self::DEFAULT_INSTANCE);
        $this->updateCart();
    }

    protected function createCartItem(int $id, string $name, float $price, int $restaurantId, string $restaurantName): Collection
    {
        return collect([
            "id" => $id,
            'name' => $name,
            'price' => $price,
            'quantity' => 1,
            'restaurant_id' => $restaurantId,
            'restaurant_name' => $restaurantName,
        ]);
    }

    public function updateCart()
    {
        $this->total = $this->total();
        $this->items = $this->getContent();
        $this->totalItems = $this->getContent()->reduce(fn ($total, Collection $item) => $total + $item->get("quantity")) ?? 0;
        $this->restaurantName = $this->getContent()->first()?->get("restaurant_name") ?? '';
    }
}
