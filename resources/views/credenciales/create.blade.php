<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('New Credential') }}
            </h2>
            <Link href="#excel_modal" class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200">
                Cargar Excel
            </Link>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <x-splade-form method="post" :action="route('credenciales.store')" :default="$credencial" preserve-scroll>
                @include('credenciales.partials.credencial-form')
            </x-splade-form>
        </div>
    </div>

    <x-modal-excel nombre="excel_modal" titulo="Cargar desde plantilla Excel" :ruta="route('credenciales.upload')" :fila="9" />
</x-app-layout>
