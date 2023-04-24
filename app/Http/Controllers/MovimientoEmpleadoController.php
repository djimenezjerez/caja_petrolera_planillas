<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\MovimientoEmpleado;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UploadExcelRequest;
use App\Imports\MovimientoEmpleadosImport;
use App\Http\Requests\StoreMovimientoEmpleadoRequest;
use App\Http\Requests\UpdateMovimientoEmpleadoRequest;

class MovimientoEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $empresa = Empresa::find(Session::get('empresa_id'));
        $global = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query->orWhere('empleados.apellido_paterno', 'like', "%{$value}%")->orWhere('empleados.apellido_materno', 'like', "%{$value}%")->orWhere('empleados.nombre', 'like', "%{$value}%")->orWhere('empleados.cedula_identidad', 'like', "%{$value}%");
                });
            });
        });
        $datos = QueryBuilder::for(MovimientoEmpleado::select('movimiento_empleados.*', 'empleados.apellido_paterno as empleados.apellido_paterno', 'empleados.apellido_materno as empleados.apellido_materno', 'empleados.nombre as empleados.nombre', 'empleados.cedula_identidad as empleados.cedula_identidad', 'empleados.complemento_cedula as empleados.complemento_cedula', 'empleados.ciudad_id as empleados.ciudad_id', 'ciudades.codigo as ciudades.codigo', 'cargos.nombre as cargos.nombre')->leftJoin('empleados', 'empleados.id', '=', 'movimiento_empleados.empleado_id')->leftJoin('cargos', 'cargos.id', '=', 'movimiento_empleados.cargo_id')->leftJoin('ciudades', 'ciudades.id', '=', 'empleados.ciudad_id')->where('movimiento_empleados.empresa_id', $empresa->id))->defaultSort('fecha_ingreso')->allowedSorts(['fecha_ingreso', 'fecha_retiro', 'empleados.apellido_paterno', 'empleados.apellido_materno', 'empleados.nombre', 'empleados.cedula_identidad'])->allowedFilters(['empleados.apellido_paterno', 'empleados.apellido_materno', 'empleados.nombre', 'empleados.cedula_identidad', $global]);

        return view('movimiento_empleados.index', [
            'datos' => SpladeTable::for($datos)->column(key: 'empleados.cedula_identidad', label: 'CARNET DE IDENTIDAD', sortable: true, canBeHidden: false)->column(key: 'empleados.apellido_paterno', label: 'APELLIDO PATERNO', sortable: true, canBeHidden: false)->withGlobalSearch(columns: ['empleados.apellido_paterno', 'empleados.apellido_materno', 'empleados.nombre', 'empleados.cedula_identidad'])->paginate(8)->perPageOptions ([8, 15, 30]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMovimientoEmpleadoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MovimientoEmpleado $movimientoEmpleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MovimientoEmpleado $movimientoEmpleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovimientoEmpleadoRequest $request, MovimientoEmpleado $movimientoEmpleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovimientoEmpleado $movimientoEmpleado)
    {
        //
    }

    public function upload(UploadExcelRequest $request)
    {
        try {
            Excel::import(new MovimientoEmpleadosImport, $request->archivo);
        } catch(\Exception $e) {
            Toast::title('Error')->message('Plantilla Excel incompatible')->autoDismiss(15)->warning();
        }
        return redirect()->route('movimiento_empleados.index');
    }
}
