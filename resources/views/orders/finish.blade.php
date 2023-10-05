<x-app-layout>
    <div x-data="{ modelOpen: false }" class="p-6 text-gray-900 flex flex-row justify-between">
        <div class="max-w-lg">
            <h1 class="font-black mb-10 text-4xl text-gray-900">Finalize seu pedido</h1>
            <section class="border-b pb-4 mb-4" x-data="{ delivery: true }">
                <ul class="flex flex-row justify-start gap-14 items-center text-gray-300 mb-6">
                    <li @click="delivery = true" :class="delivery ? 'box text-red-600 border-red-600' : 'text-gray-300 hover:border-gray-300 hover:cursor-pointer border-transparent'" class="transition py-3 border-b-2">Entrega</li>
                    <li @click="delivery = false" :class="!delivery ? 'box text-red-600 border-red-600' : 'text-gray-300 hover:border-gray-300 border-transparent hover:cursor-pointer'" class="transition py-3 border-b-2">Retirada</li>
                </ul>
                <div x-show="delivery">
                    <p>Rua Teste, 123</p>
                    <p class="text-gray-400">São Paulo/SP</p>
                </div>
                <div x-show="!delivery">
                    <p>Rua Teste Restaurante, 123</p>
                </div>
            </section>
            <section x-data="{ payOnDelivery: false, selected: 0 }" class="border-b pb-14 mb-10">
                <ul class="flex flex-row justify-start gap-8 items-center text-gray-300 mb-4">
                    <li @click="payOnDelivery = false" :class="!payOnDelivery ? 'box text-red-600 border-red-600' : 'text-gray-300 hover:border-gray-300 hover:cursor-pointer border-transparent'" class="transition py-3 border-b-2">Page pelo site</li>
                    <li @click="payOnDelivery = true" :class="payOnDelivery ? 'box text-red-600 border-red-600' : 'text-gray-300 hover:border-gray-300 hover:cursor-pointer border-transparent'" class="transition py-3 border-b-2 ">Pague na entrega</li>
                </ul>
                <div x-show="!payOnDelivery">
                    <div @click="selected = (selected === 'pix' ? 0 : 'pix')" :class="selected === 'pix' ? 'border-red-600' : 'hover:shadow-lg'" class="flex flex-row gap-6 px-6 py-4 border rounded-lg items-center cursor-pointer">
                        <x-icon.pix />
                        <div>
                            <p>Pague com Pix</p>
                            <p class="text-gray-400">Use o QR Code ou copie e cole o código</p>
                        </div>
                    </div></div>
                <div x-show="payOnDelivery" class="grid grid-cols-2 gap-4">
                    <article @click="selected = (selected === 1) ? 0 : 1" :class="selected == 1 ? 'bg-green-100' : ''" class="flex items-center gap-4 border rounded-lg px-4 hover:bg-green-100 cursor-pointer">
                        <x-icon.money  />
                        <h4 class="text-sm font-light">Dinheiro</h4>
                    </article>
                    <article @click="selected = (selected === 2) ? 0 : 2" :class="selected == 2 ? 'bg-green-100' : ''" class="flex items-center gap-4 border rounded-lg px-4 hover:bg-green-100 cursor-pointer">
                        <x-icon.mastercard  />
                        <h4 class="text-sm font-light">Mastercard</h4>
                    </article>
                </div>
            </section>
            <section class="flex flex-row items-center gap-2" x-data="{ useDocumentInInvoice: true }">
                <div class="relative">
                    <label  for="document" class="absolute left-3.5 -top-2 px-1 bg-white text-xs text-gray-400">CPF/CNPJ na nota</label>
                    <input :disabled="useDocumentInInvoice" type="text" id="document" name="document" class="border rounded border-gray-300 focus:border-gray-300 focus:outline-none focus:ring-0">
                </div>
                <div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input @click="useDocumentInInvoice = !useDocumentInInvoice; document.getElementById('document').value = ''" type="checkbox" value="" name="invoice-document" class="sr-only peer">
                        <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-transparent rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-red-600"></div>
                    </label>
                </div>
            </section>
            <section class="my-6">
                <button @click="modelOpen =!modelOpen" class="text-center w-full block py-3 text-white bg-red-600 hover:bg-red-500 rounded font-medium">Fazer pedido</button>
            </section>
        </div>




        <div>

            <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="transition ease-in duration-200 transform"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"
                    ></div>

                    <div x-cloak x-show="modelOpen"
                         x-transition:enter="transition ease-out duration-300 transform"
                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave="transition ease-in duration-200 transform"
                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                         class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                    >
                        <h2 class="font-black mb-10 text-4xl text-gray-900">Pedido Finalizado</h2>
                        <hp class="text-gray-400">Seu pedido agora esta em processamento</hp>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
