<x-splade-modal max-width="3xl">
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle de Relación de Ingresos y Salidas
        </h2>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="py-4 bg-white border-b border-gray-400">
            <div class="text-lg text-gray-800 font-sans underline">Datos del Empleado</div>
            <table class="table-auto" style="width: 100%">
                <colgroup>
                    <col width="35%"/>
                    <col width="65%"/>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="text-end pr-3" scope="row">Nombre:</th>
                        <td>{{ $movimientoEmpleado->empleado->nombre_completo }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">C.I.:</th>
                        <td>{{ $movimientoEmpleado->empleado->cedula_completa }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="py-4 bg-white border-b border-gray-400">
            <div class="text-lg text-gray-800 font-sans underline">Datos de la Empresa</div>
            <table class="table-auto" style="width: 100%">
                <colgroup>
                    <col width="35%"/>
                    <col width="65%"/>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="text-end pr-3" scope="row">Nombre:</th>
                        <td>{{ $movimientoEmpleado->credencial->empresa->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Cargo:</th>
                        <td>{{ $movimientoEmpleado->cargo->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Ingreso:</th>
                        <td>{{ $movimientoEmpleado->fecha_ingreso->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Retiro:</th>
                        <td>{{ $movimientoEmpleado->fecha_retiro ? $movimientoEmpleado->fecha_retiro->format('d/m/Y') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="py-4 bg-white border-b border-gray-400">
            <div class="text-lg text-gray-800 font-sans underline">Parte CPS</div>
            <table class="table-auto" style="width: 100%">
                <colgroup>
                    <col width="35%"/>
                    <col width="65%"/>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Ingreso:</th>
                        <td>{{ $movimientoEmpleado->parte_cps_fecha_ingreso ? $movimientoEmpleado->parte_cps_fecha_ingreso->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Presentación de Ingreso:</th>
                        <td>{{ $movimientoEmpleado->presentacion_cps_fecha_ingreso ? $movimientoEmpleado->presentacion_cps_fecha_ingreso->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Retiro:</th>
                        <td>{{ $movimientoEmpleado->parte_cps_fecha_retiro ? $movimientoEmpleado->parte_cps_fecha_retiro->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Presentación de Retiro:</th>
                        <td>{{ $movimientoEmpleado->presentacion_cps_fecha_retiro ? $movimientoEmpleado->presentacion_cps_fecha_retiro->format('d/m/Y') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="py-4 bg-white border-b border-gray-400">
            <div class="text-lg text-gray-800 font-sans underline">Contrato</div>
            <table class="table-auto" style="width: 100%">
                <colgroup>
                    <col width="35%"/>
                    <col width="65%"/>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Ingreso:</th>
                        <td>{{ $movimientoEmpleado->contrato_fecha_ingreso ? $movimientoEmpleado->contrato_fecha_ingreso->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Retiro:</th>
                        <td>{{ $movimientoEmpleado->contrato_fecha_retiro ? $movimientoEmpleado->contrato_fecha_retiro->format('d/m/Y') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="py-4 bg-white border-b border-gray-400">
            <div class="text-lg text-gray-800 font-sans underline">Finiquito</div>
            <table class="table-auto" style="width: 100%">
                <colgroup>
                    <col width="35%"/>
                    <col width="65%"/>
                </colgroup>
                <tbody>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Ingreso:</th>
                        <td>{{ $movimientoEmpleado->finiquito_fecha_ingreso ? $movimientoEmpleado->finiquito_fecha_ingreso->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-end pr-3" scope="row">Fecha de Retiro:</th>
                        <td>{{ $movimientoEmpleado->finiquito_fecha_retiro ? $movimientoEmpleado->finiquito_fecha_retiro->format('d/m/Y') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="pt-4 bg-white">
            <button class="border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-indigo-500 hover:bg-indigo-700 text-white border-transparent focus:border-indigo-300 focus:ring-indigo-200" type="button" @click="modal.close">Cerrar</button>
        </div>
    </div>
</x-splade-modal>
