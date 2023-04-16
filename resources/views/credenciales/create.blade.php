<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Credential') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-form method="post" :action="route('credenciales.store')" :default="$credencial" preserve-scroll>
                @include('credenciales.partials.credencial-form')
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
