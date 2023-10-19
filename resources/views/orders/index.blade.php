<x-app-layout>
    <h1 class="text-2xl	text-gray-600 mb-8">Pedidos</h1>

    <div class="grid grid-cols-3 gap-4">
            <article class="border rounded-lg flex flex-col border-red-600">
                <div class="px-6 py-4">
                    <h3 class="font-semibold text-lg mb-2">EM PREPARAÇÀO</h3>
                    <h3 class="font-normal text-gray-600 text-lg mb-2">Maldonado-de Arruda</h3>
                    <p class="font-light text-sm text-gray-500">Rua Afonso Zampol, 12

                        São Paulo / SP</p>
                </div>
                <div class="px-6 py-4 flex flex-row justify-between">
                    <span>R$ {{ number_format('128.89', 2, ",") }}</span>
                </div>
            </article>
    </div>
</x-app-layout>
