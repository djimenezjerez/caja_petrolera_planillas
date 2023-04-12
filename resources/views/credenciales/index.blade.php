<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Credentials') }}
            </h2>
            <Link href="{{ route('credenciales.create') }}" class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-blue-500 hover:bg-blue-700 text-white border-transparent focus:border-blue-300 focus:ring-indigo-200">
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
                            <Link href="{{ route('credenciales.show', $item->id) }}" class="inline flex-items">
                            <button class="inline-flex items-center justify-center w-7 h-7 mr-2 text-blue-700 transition-colors duration-150 bg-white rounded-full focus:shadow-outline hover:bg-blue-200">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                            </button>
                            </Link>
                        </x-splade-cell>
                    </x-splade-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
