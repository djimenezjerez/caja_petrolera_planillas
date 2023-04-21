<x-credencial-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight py-2">
                Datos de la empresa
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-400">
                    <div class="text-xl text-gray-800 font-sans underline">Datos de la Credencial</div>
                    <table class="table-auto" style="width: 100%">
                        <colgroup>
                            <col width="25%"/>
                            <col width="75%"/>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="text-end pr-3" scope="row">Cite:</th>
                                <td>{{ $credencial->cite }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Inicio de la Fiscalización:</th>
                                <td>{{ $credencial->inicio_fizcalizacion ? $credencial->inicio_fizcalizacion->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Gestiones:</th>
                                <td>{{ $credencial->gestiones->implode(', ') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-white border-b border-gray-400">
                    <div class="text-xl text-gray-800 font-sans underline">Datos de la Empresa</div>
                    <table class="table-auto" style="width: 100%">
                        <colgroup>
                            <col width="25%"/>
                            <col width="75%"/>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="text-end pr-3" scope="row">Nombre:</th>
                                <td>{{ $credencial->empresa->nombre }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Fecha de Afiliación:</th>
                                <td>{{ $credencial->empresa->fecha_afiliacion ? $credencial->empresa->fecha_afiliacion->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">NIT:</th>
                                <td>{{ $credencial->empresa->nit ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Régimen Tributario:</th>
                                <td>{{ $credencial->empresa->regimen_tributario ? $credencial->empresa->regimen_tributario->nombre : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Número de Empleador:</th>
                                <td>{{ $credencial->empresa->roe ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Tipo de Empresa:</th>
                                <td>{{ $credencial->empresa->tipo_empresa ? $credencial->empresa->tipo_empresa->nombre : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Fundempresa:</th>
                                <td>{{ $credencial->empresa->fundempresa ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">ROE:</th>
                                <td>{{ $credencial->empresa->roe ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Teléfono(s):</th>
                                <td>{{ $credencial->empresa->telefonos ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Ciudad:</th>
                                <td>{{ $credencial->empresa->ciudad ? $credencial->empresa->ciudad->nombre : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Domicilio Legal:</th>
                                <td>{{ $credencial->empresa->domicilio ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-6 bg-white border-b border-gray-400">
                    <div class="text-xl text-gray-800 font-sans underline">Datos del Representante Legal</div>
                    <table class="table-auto" style="width: 100%">
                        <colgroup>
                            <col width="25%"/>
                            <col width="75%"/>
                        </colgroup>
                        <tbody>
                            <tr>
                                <th class="text-end pr-3" scope="row">Apellido Paterno:</th>
                                <td>
                                    @if ($credencial->empresa->representante_legal)
                                        {{ $credencial->empresa->representante_legal->apellido_paterno }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Apellido Materno:</th>
                                <td>{{ $credencial->empresa->representante_legal->apellido_materno ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Nombre(s):</th>
                                <td>{{ $credencial->empresa->representante_legal->nombre ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Cédula de Identidad:</th>
                                <td>{{ $credencial->empresa->representante_legal->cedula_identidad ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Complemento:</th>
                                <td>{{ $credencial->empresa->representante_legal->complemento_cedula ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Ciudad de Expedición:</th>
                                <td>
                                    @if ($credencial->empresa->representante_legal)
                                        {{ $credencial->empresa->representante_legal->ciudad ? $credencial->empresa->representante_legal->ciudad->nombre : '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="text-end pr-3" scope="row">Domicilio:</th>
                                <td>{{ $credencial->empresa->domicilio_representante ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-credencial-layout>
