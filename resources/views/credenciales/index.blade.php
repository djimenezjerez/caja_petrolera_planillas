<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Credentials') }}
            </h2>
            <Link href="{{ route('credenciales.create') }}" class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200">
                Nueva
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
                        <x-splade-cell action>
                            <Link href="{{ route('credenciales.edit', $item->id) }}" class="inline flex-items">
                                <button class="inline-flex items-center justify-center w-7 h-7 mr-2 text-indigo-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-indigo-200">
                                    <svg stroke-width="1.5" fill="none" stroke="currentColor" viewBox="0 0 22 24" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                </button>
                            </Link>
                            <Link href="{{ route('credenciales.destroy', $item->id) }}" method="DELETE" class="inline flex-items" confirm="Eliminar credencial" confirm-text="¿Seguro que desea eliminar la credencial?" confirm-button="Si" cancel-button="No">
                                <button class="inline-flex items-center justify-center w-7 h-7 mr-2 text-red-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-red-200">
                                    <svg stroke-width="1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </Link>
                        </x-splade-cell>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
