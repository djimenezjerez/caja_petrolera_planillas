<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Credential') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form method="post" :action="route('credenciales.store')" class="mt-6 space-y-6" preserve-scroll>
                        <div class="grid grid-cols-6 gap-4">
                            <x-splade-input class="col-span-6 md:col-span-4" id="empresa" name="empresa" type="text" :label="__('Business')" required autofocus autocomplete="empresa" />
                            <x-splade-input class="col-span-6 sm:col-span-3 md:col-span-1" id="gestion_inicial" name="gestion_inicial" type="number" :label="__('Start year')" required />
                            <x-splade-input class="col-span-6 sm:col-span-3 md:col-span-1" id="gestion_final" name="gestion_final" type="number" :label="__('Final year')" required />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-splade-submit class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-blue-500 hover:bg-blue-700 text-white border-transparent focus:border-indigo-300 focus:ring-blue-200" :label="__('Save')" />
                        </div>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
