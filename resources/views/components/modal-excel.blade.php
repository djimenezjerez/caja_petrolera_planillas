<x-splade-modal name="{{ $nombre }}" max-width="3xl">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight pb-4">
        {{ $titulo }}
    </h2>
    <x-splade-form :action="$ruta">
        <x-splade-file class="col-span-1 mb-4" name="archivo" filepond="{ credits: false }" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" max-size="10MB" />
        <div class="sm:flex">
            <x-splade-submit class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200" :label="__('Upload')" />
            <button class="rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm" type="button" @click="modal.close">Cancelar</button>
        </div>
    </x-splade-form>
</x-splade-modal>
