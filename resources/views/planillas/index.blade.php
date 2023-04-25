<x-credencial-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2">
                Planillas de Sueldos
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <div class="text-xl text-gray-800 font-sans underline">Seleccione la Gestión</div>
                    <div class="pt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                        @foreach($planillas as $planilla)
                        <Link href="{{ route('planillas.show', $planilla->id) }}" class="col-span-1 w-full h-12 transition-colors duration-150 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200 text-center">
                            {{ $planilla->gestion->anio }}
                        </Link>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-credencial-layout>
