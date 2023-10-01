<?php

use Livewire\Volt\Component;

new class extends Component
{
    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="z-50 fixed bg-white border-b border-gray-100 w-full border-b border-gray-300">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="/" wire:navigate>
                        <x-logo.application class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('restaurants')" :active="request()->routeIs('restaurants')" wire:navigate>
                        Restaurantes
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth()
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <button class="text-red-600 text-xs flex gap-2 items-center">
                        <span class="font-medium text-gray-600 text-sm">Selecionar Endereço</span> <x-icon.chevron-down/>
                    </button>
                    <x-dropdown align="right" width="w-80">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="fill-red-600" x-on:profile-updated.window="name = $event.detail.name"><x-icon.user/></div>
                            </button>
                        </x-slot>

                        <x-slot name="content" class="text-lg">
                            <h2 class="px-10 pt-8 pb-5 font-medium text-2xl">Ola, {{ auth()->user()->name }}</h2>

                            <x-dropdown-link class="px-10 py-2.5" :href="route('profile')" wire:navigate>
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <button wire:click="logout" class="w-full text-left">
                                <x-dropdown-link class="px-10 py-2.5">
                                    Sair
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                    <livewire:cart></livewire:cart>
                </div>
            @endauth
            @guest()
                <a class="fill-red-600 text-red-600" href="{{ route("login") }}">
                    <x-icon.login/>
                </a>
            @endguest

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth()
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800" x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-left">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth
    </div>

</nav>

