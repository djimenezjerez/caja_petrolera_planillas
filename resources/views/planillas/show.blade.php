<x-credencial-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Planilla de Sueldos - Gestion {{ $planilla->gestion->anio }}
            </h2>
            <Link href="#excel_modal" class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200">
                Cargar Excel
            </Link>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                </div>
            </div>
        </div>
    </div>

    <x-modal-excel nombre="excel_modal" titulo="Cargar planilla desde Excel" :ruta="route('planillas.upload', $planilla->id)" fila="9" columna="A" />
</x-credencial-layout>
