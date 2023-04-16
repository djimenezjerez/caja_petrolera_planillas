<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use App\Models\Empresa;
use App\Models\Gestion;
use App\Models\Empleado;
use App\Models\Credencial;
use App\Models\TipoEmpresa;
use Illuminate\Http\Request;
use App\Models\RegimenTributario;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreCredencialRequest;
use App\Http\Requests\UpdateCredencialRequest;

class CredencialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $credenciales = QueryBuilder::for(Credencial::select('credenciales.id', 'credenciales.empresa_id', 'empresas.nombre')->where('user_id', auth()->user()->id)->leftJoin('empresas', 'empresas.id', '=', 'credenciales.empresa_id'))->defaultSort(['empresas.nombre'])->allowedSorts(['empresas.nombre'])->paginate(8)->withQueryString();
        $global = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query->orWhere('empresas.nombre', 'like', "%{$value}%");
                });
            });
        });
        $credenciales = QueryBuilder::for(Credencial::select('credenciales.id', 'credenciales.empresa_id', 'empresas.nombre as empresas.nombre')->leftJoin('empresas', 'empresas.id', '=', 'credenciales.empresa_id')->where('credenciales.user_id', auth()->user()->id))->defaultSort('empresas.nombre')->allowedSorts('empresas.nombre')->allowedFilters(['empresas.nombre', $global]);

        return view('credenciales.index', [
            'datos' => SpladeTable::for($credenciales)->column(key: 'empresas.nombre', label: 'EMPRESA', sortable: true, canBeHidden: false)->column(key: 'action', label: 'ACCIONES', canBeHidden: false, alignment: 'center')->withGlobalSearch(columns: ['empresas.nombre'])->paginate(8)->perPageOptions ([8, 15, 30]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regimenes = RegimenTributario::orderBy('orden')->get();
        $tipos_empresas = TipoEmpresa::orderBy('orden')->get();
        $ciudades = Ciudad::orderBy('orden')->get();
        $credencial = [
            'credencial_cite' => null,
            'credencial_inicio_fizcalizacion' => null,
            'credencial_gestion_inicial' => null,
            'credencial_gestion_final' => null,
            'empresa_nombre' => null,
            'empresa_fecha_afiliacion' => null,
            'empresa_nit' => null,
            'empresa_regimen_tributario_id' => null,
            'empresa_actividad' => null,
            'empresa_numero_empleador' => null,
            'empresa_tipo_empresa_id' => null,
            'empresa_fundempresa' => null,
            'empresa_roe' => null,
            'empresa_telefonos' => null,
            'empresa_ciudad_id' => null,
            'empresa_domicilio' => null,
            'empresa_domicilio_representante' => null,
            'representante_apellido_paterno' => null,
            'representante_apellido_materno' => null,
            'representante_nombre' => null,
            'representante_cedula_identidad' => null,
            'representante_complemento_cedula' => null,
            'representante_ciudad_id' => null,
        ];
        return view('credenciales.create', compact('credencial', 'regimenes', 'tipos_empresas', 'ciudades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCredencialRequest $request)
    {
        DB::beginTransaction();
        try {
            $repesentante = null;
            if ($request->representante_cedula_identidad != null && $request->representante_cedula_identidad != '') {
                $repesentante = Empleado::updateOrCreate([
                    'cedula_identidad' => $request->representante_cedula_identidad,
                ], [
                    'apellido_paterno' => $request->representante_apellido_paterno,
                    'apellido_materno' => $request->representante_apellido_materno,
                    'nombre' => $request->representante_nombre,
                    'complemento_cedula' => $request->representante_complemento_cedula,
                    'ciudad_id' => $request->representante_ciudad_id,
                ]);
            }
            $empresa = Empresa::updateOrCreate([
                'nombre' => $request->empresa_nombre,
            ], [
                'nit' => $request->empresa_nit,
                'regimen_tributario_id' => $request->empresa_regimen_tributario_id,
                'numero_empleador' => $request->empresa_numero_empleador,
                'fecha_afiliacion' => $request->empresa_fecha_afiliacion,
                'actividad' => $request->empresa_actividad,
                'tipo_empresa_id' => $request->empresa_tipo_empresa_id,
                'fundempresa' => $request->empresa_fundempresa,
                'roe' => $request->empresa_roe,
                'telefonos' => $request->empresa_telefonos,
                'ciudad_id' => $request->empresa_ciudad_id,
                'domicilio' => $request->empresa_domicilio,
                'empleado_id' => $repesentante != null ? $repesentante->id : null,
                'domicilio_representante' => $request->empresa_domicilio_representante,
            ]);
            $credencial = Credencial::create([
                'empresa_id' => $empresa->id,
                'user_id' => auth()->user()->id,
                'cite' => $request->credencial_cite,
                'inicio_fizcalizacion' => $request->credencial_inicio_fizcalizacion,
            ]);
            for ($i=$request->credencial_gestion_inicial; $i<=$request->credencial_gestion_final; $i++) {
                $gestion = Gestion::firstOrCreate([
                    'anio' => $i,
                ]);
                $gestion->planilla()->firstOrCreate([
                    'credencial_id' => $credencial->id,
                ]);
            }
            DB::commit();
            Toast::title('Éxito')->message('Registro almacenado exitósamente')->autoDismiss(15);
            return redirect()->route('credenciales.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            Toast::title('Error')->message('Error interno al guardar el registro')->warning()->autoDismiss(15);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Credencial $credencial)
    {
        return view('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credencial $credencial)
    {
        $regimenes = RegimenTributario::orderBy('orden')->get();
        $tipos_empresas = TipoEmpresa::orderBy('orden')->get();
        $ciudades = Ciudad::orderBy('orden')->get();
        $gestiones = $credencial->planillas()->select('gestiones.anio')->leftJoin('gestiones', 'gestiones.id', '=', 'planillas.gestion_id')->orderBy('gestiones.anio')->pluck('anio');
        $credencial = [
            'credencial_id' => $credencial->id,
            'credencial_cite' => $credencial->cite,
            'credencial_inicio_fizcalizacion' => $credencial->inicio_fizcalizacion->format('d/m/Y'),
            'credencial_gestion_inicial' => $gestiones->first(),
            'credencial_gestion_final' => $gestiones->last(),
            'empresa_nombre' => $credencial->empresa->nombre,
            'empresa_fecha_afiliacion' => $credencial->empresa->fecha_afiliacion->format('d/m/Y'),
            'empresa_nit' => $credencial->empresa->nit,
            'empresa_regimen_tributario_id' => $credencial->empresa->regimen_tributario_id,
            'empresa_actividad' => $credencial->empresa->actividad,
            'empresa_numero_empleador' => $credencial->empresa->numero_empleador,
            'empresa_tipo_empresa_id' => $credencial->empresa->tipo_empresa_id,
            'empresa_fundempresa' => $credencial->empresa->fundempresa,
            'empresa_roe' => $credencial->empresa->roe,
            'empresa_telefonos' => $credencial->empresa->telefonos,
            'empresa_ciudad_id' => $credencial->empresa->ciudad_id,
            'empresa_domicilio' => $credencial->empresa->domicilio,
            'empresa_domicilio_representante' => $credencial->empresa->domicilio_representante,
            'representante_apellido_paterno' => $credencial->empresa->representante_legal ? $credencial->empresa->representante_legal->apellido_paterno : null,
            'representante_apellido_materno' => $credencial->empresa->representante_legal ? $credencial->empresa->representante_legal->apellido_materno : null,
            'representante_nombre' => $credencial->empresa->representante_legal ? $credencial->empresa->representante_legal->nombre : null,
            'representante_cedula_identidad' => $credencial->empresa->representante_legal ? $credencial->empresa->representante_legal->cedula_identidad : null,
            'representante_complemento_cedula' => $credencial->empresa->representante_legal ? $credencial->empresa->representante_legal->complemento_cedula : null,
            'representante_ciudad_id' => $credencial->empresa->representante_legal ? $credencial->empresa->representante_legal->ciudad_id : null,
        ];
        return view('credenciales.edit', compact('credencial', 'regimenes', 'tipos_empresas', 'ciudades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCredencialRequest $request, Credencial $credencial)
    {
        DB::beginTransaction();
        try {
            $repesentante = null;
            if ($request->representante_cedula_identidad != null && $request->representante_cedula_identidad != '') {
                $repesentante = Empleado::updateOrCreate([
                    'cedula_identidad' => $request->representante_cedula_identidad,
                ], [
                    'apellido_paterno' => $request->representante_apellido_paterno,
                    'apellido_materno' => $request->representante_apellido_materno,
                    'nombre' => $request->representante_nombre,
                    'complemento_cedula' => $request->representante_complemento_cedula,
                    'ciudad_id' => $request->representante_ciudad_id,
                ]);
            }
            $empresa = Empresa::updateOrCreate([
                'nombre' => $request->empresa_nombre,
            ], [
                'nit' => $request->empresa_nit,
                'regimen_tributario_id' => $request->empresa_regimen_tributario_id,
                'numero_empleador' => $request->empresa_numero_empleador,
                'fecha_afiliacion' => $request->empresa_fecha_afiliacion,
                'actividad' => $request->empresa_actividad,
                'tipo_empresa_id' => $request->empresa_tipo_empresa_id,
                'fundempresa' => $request->empresa_fundempresa,
                'roe' => $request->empresa_roe,
                'telefonos' => $request->empresa_telefonos,
                'ciudad_id' => $request->empresa_ciudad_id,
                'domicilio' => $request->empresa_domicilio,
                'empleado_id' => $repesentante != null ? $repesentante->id : null,
                'domicilio_representante' => $request->empresa_domicilio_representante,
            ]);
            $credencial->update([
                'empresa_id' => $empresa->id,
                'cite' => $request->credencial_cite,
                'inicio_fizcalizacion' => $request->credencial_inicio_fizcalizacion,
            ]);
            $gestiones_registradas = $credencial->planillas()->select('gestiones.anio')->leftJoin('gestiones', 'gestiones.id', '=', 'planillas.gestion_id')->orderBy('gestiones.anio')->pluck('anio')->toArray();
            $gestiones_nuevas = range($request->credencial_gestion_inicial, $request->credencial_gestion_final);
            $eliminar = array_diff($gestiones_registradas, $gestiones_nuevas);
            foreach ($eliminar as $gestion) {
                $planillas = $credencial->planillas()->select('planillas.*')->leftJoin('gestiones', 'gestiones.id', '=', 'planillas.gestion_id')->where('gestiones.anio', $gestion)->orderBy('gestiones.anio')->get();
                foreach ($planillas as $planilla) {
                    foreach ($planilla->meses as $mes) {
                        $mes->importe->delete();
                        $mes->total->delete();
                        $mes->delete();
                    }
                    foreach ($planilla->empleados as $empleado) {
                        $empleado->importe->delete();
                        $empleado->delete();
                    }
                    $planilla->delete();
                }
            }
            $insertar = array_diff($gestiones_nuevas, $gestiones_registradas);
            foreach ($insertar as $gestion) {
                $gestion = Gestion::firstOrCreate([
                    'anio' => $gestion,
                ]);
                $gestion->planilla()->firstOrCreate([
                    'credencial_id' => $credencial->id,
                ]);
            }
            DB::commit();
            Toast::title('Éxito')->message('Registro modificado exitósamente')->autoDismiss(15);
            return redirect()->route('credenciales.index');
        } catch (\Exception $e) {
            DB::rollBack();
            logger($e);
            Toast::title('Error')->message('Error interno al guardar el registro')->warning()->autoDismiss(15);
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credencial $credencial)
    {
        foreach ($credencial->planillas as $planilla) {
            foreach ($planilla->meses as $mes) {
                $mes->importe->delete();
                $mes->total->delete();
                $mes->delete();
            }
            foreach ($planilla->empleados as $empleado) {
                $empleado->importe->delete();
                $empleado->delete();
            }
            $planilla->delete();
        }
        $credencial->delete();
        return redirect()->route('credenciales.index');
    }

    public function upload(Request $request)
    {
        $regimenes = RegimenTributario::orderBy('orden')->get();
        $tipos_empresas = TipoEmpresa::orderBy('orden')->get();
        $ciudades = Ciudad::orderBy('orden')->get();
        $credencial = [
            'credencial_cite' => null,
            'credencial_inicio_fizcalizacion' => null,
            'credencial_gestion_inicial' => null,
            'credencial_gestion_final' => null,
            'empresa_nombre' => null,
            'empresa_fecha_afiliacion' => null,
            'empresa_nit' => null,
            'empresa_regimen_tributario_id' => null,
            'empresa_actividad' => null,
            'empresa_numero_empleador' => null,
            'empresa_tipo_empresa_id' => null,
            'empresa_fundempresa' => null,
            'empresa_roe' => null,
            'empresa_telefonos' => null,
            'empresa_ciudad_id' => null,
            'empresa_domicilio' => null,
            'empresa_domicilio_representante' => null,
            'representante_apellido_paterno' => null,
            'representante_apellido_materno' => null,
            'representante_nombre' => null,
            'representante_cedula_identidad' => null,
            'representante_complemento_cedula' => null,
            'representante_ciudad_id' => null,
        ];
        return view('credenciales.create', compact('credencial', 'regimenes', 'tipos_empresas', 'ciudades'));
    }
}
