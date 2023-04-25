<x-credencial-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Relación de Ingresos y Salidas del Personal
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
                    <x-splade-table :for="$datos">
                        <x-slot:empty-state>
                            <p class="text-gray-700 px-6 py-12 font-medium text-sm text-center">Sin resultados</p>
                        </x-slot>
                        <x-splade-cell action>
                            <Link modal href="{{ route('movimiento_empleados.show', $item->id) }}" class="inline flex-items">
                                <button class="inline-flex items-center justify-center w-7 h-7 mr-2 text-cyan-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-cyan-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </Link>
                        </x-splade-cell>
                        <x-splade-cell fecha_retiro>
                            <div class="flex flex-row items-center justify-start">
                                @if ($item['fecha_retiro'])
                                    <div class="align-center font-semibold text-sm center text-bold leading-none whitespace-nowrap py-1 px-3.5 rounded-lg select-none bg-red-500 text-white">
                                        {{ $item['fecha_retiro']->format('d/m/Y') }}
                                    </div>
                                @else
                                    <div class="align-center font-semibold text-sm center text-bold leading-none whitespace-nowrap py-1 px-3.5 rounded-lg select-none bg-teal-500 text-white">
                                        Vigente
                                    </div>
                                @endif
                            </div>
                        </x-splade-cell>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>

    <x-modal-excel nombre="excel_modal" titulo="Cargar ingresos/salidas de personal desde Excel" :ruta="route('movimiento_empleados.upload')" />
</x-credencial-layout>
