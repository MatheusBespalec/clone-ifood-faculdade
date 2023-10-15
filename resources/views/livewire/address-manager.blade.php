<div class="max-w-4xl p-8 mx-auto rounded-lg">
    <section class="mb-6" x-show="['manage', 'search', 'show-results'].includes($wire.viewMode)">
        <h2 class="mb-4 text-lg text-center text-gray-600">Onde você quer receber seu pedido?</h2>
        <div class="relative">
            <x-icon.chevron-left x-show="$wire.viewMode !== 'manage'" class="absolute top-4 left-4 cursor-pointer" @click="$wire.viewMode = 'manage'" />
            <x-icon.search x-show="$wire.viewMode === 'manage'" class="absolute top-4 left-4 cursor-pointer" @click="$wire.viewMode = 'manage'" />
            <input type="text" @keyup.enter="$wire.searchAddress($event.target.value)" @focus="$wire.viewMode = 'search'" x-mask="99999-999" class="py-4 px-16 rounded bg-gray-100 border-none w-full focus:outline-none focus:ring-0" placeholder="Buscar endereço e número">
        </div>
    </section>

    <section x-show="$wire.viewMode === 'manage'">
        @foreach($addresses as $address)
            <article wire:click="changeActiveAddress({{ $address->id }})" class="{{ $address->active ? 'border-red-600' : '' }} mb-4 py-3 px-16 cursor-pointer border rounded-lg duration-300 hover:border-none hover:shadow-lg">
                <h3 class="text-gray-700 font-medium">{{ $address->name }}</h3>
                <p class="text-gray-500 text-sm">{{ $address->street }}, {{ $address->number }}</p>
            </article>
        @endforeach

        @if($addresses->count() === 0)
            <p class="text-base font-semibold text-center text-gray-500">Você não possui endereços cadastrados</p>
        @endif
    </section>

    <section x-show="$wire.viewMode === 'show-results'">
        <div class="py-4 px-16 cursor-pointer" @click="$wire.viewMode = 'create'">
            <h3 x-text="$wire.cep" class="text-base"></h3>
            <p class="text-gray-400 text-sm" x-text="`${$wire.street} - ${$wire.neighborhood}, ${$wire.city} - ${$wire.state}, Brasil`"></p>
        </div>
    </section>

    <section x-show="$wire.viewMode === 'create'" class="text-center">
        <p class="text-gray-500 font-medium" x-text="`${$wire.neighborhood}, ${$wire.street} - ${$wire.state}`"></p>
        <form id="addressForm" class="max-w-md mx-auto my-6 text-left">
            <label for="zip" class="block mb-2 font-bold">Como quer chamar esse endereço?</label>
            <input type="text"  class="w-full px-4 py-2 mb-4 border rounded-md" wire:model="addressName" placeholder="Digite o nome do endereço" required>

            <label for="street" class="block mb-2 font-bold">Número:</label>
            <input type="text"  class="w-full px-4 py-2 mb-4 border rounded-md" wire:model="number" placeholder="Digite o numero">


            <label for="street" class="block mb-2 font-bold">Complemento:</label>
            <input type="text"  class="w-full px-4 py-2 mb-4 border rounded-md" wire:model="complement" placeholder="Digite o complemento">

            <button type="button" wire:click="save()" class="px-4 py-2 text-lg bg-red-600 border rounded-md cursor-pointer hover:bg-red-500 text-white">Cadastrar Endereço</button>
        </form>
    </section>
</div>
