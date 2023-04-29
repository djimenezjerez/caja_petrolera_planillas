<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use App\Models\PlanillaSueldo;
use App\Imports\PlanillasImport;
use Maatwebsite\Excel\Facades\Excel;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UploadExcelRequest;
use App\Http\Requests\StorePlanillaRequest;
use App\Http\Requests\UpdatePlanillaRequest;

class PlanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planillas = Planilla::where('credencial_id', Session::get('credencial_id'))->leftJoin('gestiones', 'gestiones.id', '=', 'planillas.gestion_id')->orderBy('gestiones.anio')->get();
        return view('planillas.index', compact('planillas'));
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
    public function store(StorePlanillaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Planilla $planilla)
    {
        $datos = QueryBuilder::for(PlanillaSueldo::class)->with('planilla_mes.mes');

        return view('planillas.show', [
            'planilla' => $planilla,
            'datos' => SpladeTable::for($datos)->column('id')->column('planilla_mes.mes.nombre')->column('sueldo')->paginate(8)->perPageOptions([8, 15, 30]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Planilla $planilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanillaRequest $request, Planilla $planilla)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planilla $planilla)
    {
        //
    }

    public function upload(Planilla $planilla, UploadExcelRequest $request)
    {
        try {
            Excel::import(new PlanillasImport($request->fila, $planilla, Session::get('credencial_id'), Session::get('empresa_id')), $request->archivo);
            Toast::title('Éxito')->message('Plantilla Excel cargada')->autoDismiss(10);
        } catch(\Exception $e) {
            Toast::title('Error')->message($e->getMessage())->autoDismiss(10)->warning();
        }
        return redirect()->route('planillas.show', $planilla);
    }
}
