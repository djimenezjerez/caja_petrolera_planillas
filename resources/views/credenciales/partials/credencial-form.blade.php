<section>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-400">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 block text-xl text-gray-800 font-sans underline">Datos de la Credencial</div>
                <x-splade-input class="col-span-6 md:col-span-3 font-semibold" name="credencial_cite" type="text" label="Cite" required autofocus />
                <x-splade-input class="col-span-6 md:col-span-3 font-semibold" name="credencial_inicio_fizcalizacion" date label="Inicio de la Fiscalización" required />
                <x-splade-input class="col-span-6 md:col-span-3 font-semibold" name="credencial_gestion_inicial" type="number" label="Gestión Inicial" required />
                <x-splade-input class="col-span-6 md:col-span-3 font-semibold" name="credencial_gestion_final" type="number" label="Gestión Final" required />
            </div>
        </div>
        <div class="p-6 bg-white border-b border-gray-400">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 block text-xl text-gray-800 font-sans underline">Datos de la Empresa</div>
                <x-splade-input class="col-span-6 md:col-span-3 font-semibold" name="empresa_nombre" type="text" label="Nombre" required />
                <x-splade-input class="col-span-6 md:col-span-3 font-semibold" name="empresa_fecha_afiliacion" date label="Fecha de Afiliación" required />
                <x-splade-input class="col-span-6 md:col-span-3" name="empresa_nit" label="NIT" />
                <x-splade-select class="col-span-6 md:col-span-3" name="empresa_regimen_tributario_id" label="Régimen Tributario" :options="$regimenes" option-label="nombre" option-value="id" />
                <x-splade-input class="col-span-6" name="empresa_actividad" type="text" label="Actividad Principal" />
                <x-splade-input class="col-span-6 md:col-span-3" name="empresa_numero_empleador" type="text" label="Número de Empleador" />
                <x-splade-select class="col-span-6 md:col-span-3" name="empresa_tipo_empresa_id" label="Tipo de Empresa" :options="$tipos_empresas" option-label="nombre" option-value="id" />
                <x-splade-input class="col-span-6 md:col-span-3" name="empresa_fundempresa" type="text" label="Fundempresa" />
                <x-splade-input class="col-span-6 md:col-span-3" name="empresa_roe" type="text" label="ROE" />
                <x-splade-input class="col-span-6 md:col-span-3" name="empresa_telefonos" type="text" label="Teléfono(s)" />
                <x-splade-select class="col-span-6 md:col-span-3" name="empresa_ciudad_id" label="Ciudad" :options="$ciudades" option-label="nombre" option-value="id" />
                <x-splade-input class="col-span-6" name="empresa_domicilio" type="text" label="Domicilio Legal" />
            </div>
        </div>
        <div class="p-6 bg-white border-b border-gray-400">
            <div class="grid grid-cols-6 gap-4">
                <div class="col-span-6 block text-xl text-gray-800 font-sans underline">Datos del Representante Legal</div>
                <x-splade-input class="col-span-6 sm:col-span-3 md:col-span-2" name="representante_apellido_paterno" type="text" label="Apellido Paterno" />
                <x-splade-input class="col-span-6 sm:col-span-3 md:col-span-2" name="representante_apellido_materno" type="text" label="Apellido Materno" />
                <x-splade-input class="col-span-6 md:col-span-2" name="representante_nombre" type="text" label="Nombre(s)" />
                <x-splade-input class="col-span-6 sm:col-span-6 md:col-span-3" name="representante_cedula_identidad" type="number" label="Cédula de Identidad" />
                <x-splade-input class="col-span-2 md:col-span-1" name="representante_complemento_cedula" type="text" label="Complemento" />
                <x-splade-select class="col-span-4 md:col-span-2" name="representante_ciudad_id" label="Ciudad" :options="$ciudades" option-label="nombre" option-value="id" />
                <x-splade-input class="col-span-6" name="empresa_domicilio_representante" type="text" label="Domicilio del Representante" />
            </div>
        </div>
        <div class="p-6 bg-white border-b border-gray-300">
            <div class="sm:flex">
                <x-splade-submit class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200" :label="__('Save')" />
                <Link href="{{ route('credenciales.index') }}" class="rounded-md border border-gray-300 px-4 py-2 bg-white text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm" dusk="splade-confirm-cancel" type="button">Cancelar</Link>
            </div>
        </div>
    </div>
</section>
