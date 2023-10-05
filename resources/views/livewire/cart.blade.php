<div>
    <div @click="cartOpen = !cartOpen" class="cursor-pointer py-2 fill-red-600 px-3 hover:bg-gray-100 transition duration-300 rounded-full flex flex-row items-center gap-2">
        <div class="text-red-600">
            <x-icon.shopping-bag class="fill-red-600 text-red-600"></x-icon.shopping-bag>
        </div>
        <div class="flex flex-col">
            <span class="text-xs text-gray-600">R$ {{ number_format($total, 2, ",", ".") }}</span>
            <span style="font-size: .75rem; line-height: 1rem;" class="text-gray-600" >{{ $totalItems }} Itens</span>
        </div>
    </div>
    <div
        x-show="cartOpen"
        x-transition:enter="ease-out duration-700"
        x-transition:enter-start="-right-full"
        x-transition:enter-end="right-0"
        x-transition:leave="ease-in duration-700"
        x-transition:leave-start="right-0"
        x-transition:leave-end="-right-full"
        class="fixed w-full max-w-lg h-5 bg-white top-20 h-full border border-gray-300 right-0 flex flex-col justify-between">
        <x-icon.close   @click="cartOpen = !cartOpen" class="text-red-600 w-5 absolute top-2 left-2 cursor-pointer"/>
        <section class="overflow-y-auto max-h-fit">
            <div class="py-5 px-12">
                <h4 class="text-gray-500 text-sm">Seu pedido em</h4>
                <h3 class="text-lg font-medium">{{ $restaurantName }}</h3>
            </div>

            <div class="pb-5 px-12">
                <h4 class="text-gray-700 font-medium">Itens</h4>
                @foreach($items as $item)
                    <article class="pt-3 mt-2 border-t">
                        <div class="flex flex-row justify-between items-center">
                            <div class="text-base font-medium text-gray-600">{{ $item["quantity"] }} x {{ $item["name"] }}</div>
                            <div class="text-base text-gray-700 font-bold">R$ {{ number_format($item["quantity"] * $item["price"], 2, ",", ".") }}</div>
                        </div>
                        <div class="flex flex-row items-center justify-between">
                            <div>
                                <button wire:click="update({{ $item["id"] }}, 'plus')" class="text-2xl mr-2 text-red-600 font-medium">+</button>
                                <button wire:click="update({{ $item["id"] }}, 'minus')" class="text-2xl text-red-600 font-medium">-</button>
                            </div>
                            <button wire:click="remove({{ $item["id"] }})" class="text-sm text-gray-400 font-medium">Remover</button>
                        </div>
                    </article>
                @endforeach
            </div>

            <div x-show="$wire.get('totalItems')" class="pb-5 px-12">
                <button wire:click="clear" class="text-base text-gray-400 font-medium">Limpar Carrinho</button>
            </div>
        </section>

        <section class="relative top-0 h-2/6 pt-4 px-12">
            <div class="flex flex-row justify-between font-bold text-lg mb-4 text-gray-700">
                <div>Total</div>
                <div>R$ {{ number_format($total, 2, ",", ".") }}</div>
            </div>
            <a href="{{ route("orders.finish") }}" class="text-center block py-3 text-white bg-red-600 hover:bg-red-500 rounded font-medium">Escolher forma de pagamento</a>
        </section>
    </div>

</div>
