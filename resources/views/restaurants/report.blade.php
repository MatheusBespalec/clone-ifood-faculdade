<x-app-layout>
    <h1>Relatorio de pedidos: <strong>{{ $restaurant->name }}</strong></h1>
    <x-table :labels="['Data da Compra', 'Número de Pedidos', 'Valor Total das Vendas']" :lines="$report" />
</x-app-layout>
