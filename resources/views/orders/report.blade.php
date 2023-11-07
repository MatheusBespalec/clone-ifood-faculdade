<x-app-layout>
    <h1>Relatorio de pedidos</h1>

    <table>
        <thead>
            <tr>
                <th>Data da Compra</th>
                <th>Número de Pedidos</th>
                <th>Valor Total das Vendas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $line)
                <tr>
                    <td>{{ $line["date"] }}</td>
                    <td>{{ $line["orders_count"] }}</td>
                    <td>{{ $line["total"] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
