<x-app-layout>
    <h1 class="text-2xl	text-gray-600 mb-8">Em Andamento</h1>

    <div class="grid grid-cols-3 gap-4">
        @foreach([$orders->shift()] as $order)
            <article class="border rounded-lg flex flex-col border-red-600">
                <div class="px-6 py-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $order->status->label() }}</h3>
                    <h3 class="font-normal text-gray-600 text-lg mb-2">Maldonado-de Arruda</h3>
                    <p class="font-light text-sm text-gray-500">{{ $order->street }}, {{ $order->number }} - {{ $order->city }} / {{ $order->state }}</p>
                    <p class="font-light text-sm text-gray-900 mt-1">{{ $order->created_at->format("d/m/Y") }}</p>
                </div>
                <div class="px-6 py-4 flex flex-row justify-between">
                    <span>R$ {{ number_format($order->getTotal(), 2, ",", ".") }}</span>
                </div>
            </article>
        @endforeach
    </div>

    <h1 class="text-2xl	text-gray-600 my-8">Pedidos</h1>

    <div class="grid grid-cols-3 gap-4">
        @foreach($orders as $order)
            <article class="border rounded-lg flex flex-col border-red-600">
                <div class="px-6 py-4">
                    <h3 class="font-semibold text-lg mb-2">{{ $order->status->label() }}</h3>
                    <h3 class="font-normal text-gray-600 text-lg mb-2">Maldonado-de Arruda</h3>
                    <p class="font-light text-sm text-gray-500">{{ $order->street }}, {{ $order->number }} - {{ $order->city }} / {{ $order->state }}</p>
                    <p class="font-light text-sm text-gray-900 mt-1">{{ $order->created_at->format("d/m/Y") }}</p>
                </div>
                <div class="px-6 py-4 flex flex-row justify-between">
                    <span>R$ {{ number_format($order->getTotal(), 2, ",", ".") }}</span>
                </div>
            </article>
        @endforeach
    </div>
</x-app-layout>
