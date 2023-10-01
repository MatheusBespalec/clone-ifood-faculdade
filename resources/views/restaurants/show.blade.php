<x-app-layout>
    <section class="mb-5">
        <div class="flex flex-row">
            <div class="w-28 mr-10">
                <img class="w-28 h-28 bg-gray-500 rounded-full" src="{{ $restaurant->thumbnail }}" />
            </div>
            <div class="flex flex-col items-start gap-2.5 justify-center">
                <h1 class="text-4xl font-medium">{{ $restaurant->name }}</h1>
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-2xl font-medium">Produtos</h2>
        <div class="grid grid-cols-3 gap-4">
            @foreach($restaurant->products as $product)
                <article class="border rounded flex flex-col">
                    <div style="background-image: url('{{ $product->image }}')" class="h-40"></div>
                    <div class="px-6 py-4 h-40">
                        <h3 class="font-normal text-gray-600 text-lg mb-2">{{ $product->name }}</h3>
                        <p class="font-light text-sm text-gray-500">{{ $product->description }}</p>
                    </div>
                    <div class="px-6 py-4 flex flex-row justify-between">
                        <span>R$ {{ number_format($product->price, 2, ",") }}</span>
                        <button
                            @click="$dispatch('add-to-cart', { product: {
                                id: {{ $product->id }},
                                name: '{{ $product->name }}',
                                price: {{ $product->price }},
                                restaurant_id: {{ $product->restaurant_id }},
                                restaurant_name: '{{ $restaurant->name }}'
                            } });cartOpen = true"
                            class="text-white bg-red-600 hover:bg-red-500 py-1 px-4 rounded"
                        >Adicionar ao Carrinho</button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</x-app-layout>
