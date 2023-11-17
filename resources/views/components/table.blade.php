@props([
    'labels',
    'lines' => [],
])

<table class="w-full text-left border text-sm font-semibold rounded">
    <thead>
        <tr class="border border-gray-300">
            @foreach($labels as $label)
                <th class="py-3.5 px-6 bg-gray-100">{{ $label }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($lines as $line)
            <tr class="border text-gray-500">
                @foreach($line as $data)
                    <td class="py-3.5 px-6">{{ $data }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
