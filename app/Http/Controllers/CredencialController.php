<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Gestion;
use App\Models\Planilla;
use App\Models\Credencial;
use Illuminate\Support\Collection;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
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
        return view('credenciales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCredencialRequest $request)
    {
        $empresa = Empresa::firstOrCreate([
            'nombre' => $request->empresa,
        ]);
        $credencial = $empresa->credencial()->create([
            'user_id' => auth()->user()->id,
        ]);
        for ($i=$request->gestion_inicial; $i<=$request->gestion_final; $i++) {
            $gestion = Gestion::firstOrCreate([
                'anio' => $i,
            ]);
            $gestion->planilla()->create([
                'credencial_id' => $credencial->id,
            ]);
        }
        return redirect()->route('credenciales.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCredencialRequest $request, Credencial $credencial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credencial $credencial)
    {
        //
    }
}
