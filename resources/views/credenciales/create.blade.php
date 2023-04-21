<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2">
            {{ __('New Credential') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <x-splade-form :action="route('credenciales.upload')" preserve-scroll>
                <div class="p-6 bg-white border-b border-gray-400">
                    <div class="grid grid-cols-1 gap-4">
                        <x-splade-file class="col-span-1 mb-4" name="archivo" label="Cargar desde plantilla Excel" filepond="{ credits: false }" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" max-size="10MB" />
                    </div>
                    <x-splade-submit class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200" :label="__('Upload')" />
                </div>
            </x-splade-form>
            <x-splade-form method="post" :action="route('credenciales.store')" :default="$credencial" preserve-scroll>
                @include('credenciales.partials.credencial-form')
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
