<x-credencial-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
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
                            <p class="text-gray-700 px-6 py-12 font-medium text-sm text-center">Sin registros</p>
                        </x-slot>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>

    <x-splade-modal name="excel_modal" max-width="lg">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
            Cargar ingresos/salidas de personal desde Excel
        </h2>
        <x-splade-form :action="route('movimiento_empleados.upload')">
            <x-splade-file class="col-span-1 mb-4" name="archivo" filepond="{ credits: false }" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" max-size="10MB" />
            <div class="sm:flex">
                <x-splade-submit class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200" :label="__('Upload')" />
                <button class="rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm" type="button" @click="modal.close">Cancel</button>
            </div>
        </x-splade-form>
    </x-splade-modal>
</x-credencial-layout>
