<x-credencial-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Relación de Ingresos y Salidas del Personal
            </h2>
            <Link class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200">
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
                            <p class="text-gray-700 px-6 py-12 font-medium text-sm text-center">Sin registros</p>
                        </x-slot>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-credencial-layout>
