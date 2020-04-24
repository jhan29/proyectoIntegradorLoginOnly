<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tarifa;
use App\Tipo_Vehiculo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TarifaFormRequest;
use DB;

class TarifaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $request->user()->authorizeRoles(['admin','emple']);
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $tarifas=DB::table('tarifa')
            ->where('tarifa.valor','LIKE','%'.$query.'%')
            ->orderBy('tarifa.id_tarifa','desc')
            ->paginate(5);

            $tarifa =Tarifa::all();
            return view('Tarifa.index',["tarifas"=>$tarifas,"searchText"=>$query])->with('tarifa',$tarifa);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin','emple']);

        $idtarifa = DB::table('tarifa')->max('id_tarifa');
        if ($idtarifa==0) {
          $idtarifa=1;
        }else {
          $idtarifa = $idtarifa+1;
        }
        
        $idtipovehiculo=DB::table('tipo_vehiculo')
        ->select('tipo_vehiculo.nombre', 'tipo_vehiculo.id_tipo')
        ->get();

        return view ('Tarifa.create',["idtarifa"=>$idtarifa,"idtipovehiculo"=>$idtipovehiculo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TarifaFormRequest $request)
    {    
        $tarifa=new Tarifa;
        $tarifa->id_tarifa=$request->get('id_tarifa');
        $tarifa->tipo_vehiculo_id_tipo=$request->get('tipo_vehiculo_id_tipo');
        $tarifa->valor=$request->get('valor');
        $tarifa->fecha_inicio=$request->get('fecha_inicio'); 
        $tarifa->fecha_fin=$request->get('fecha_fin');
        $tarifa->save();
        return Redirect::to('tarifa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');

        $tipo_vehiculo=Tipo_Vehiculo::findOrFail($id);
        return view("Tipo_Vehiculo.edit",["tipo_vehiculo"=>$tipo_vehiculo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TarifaFormRequest $request, $id)
    {
        $tarifa = Tarifa::findOrFail($id);
        $tarifa->id_tarifa=$request->get('id_tarifa');
        $tarifa->tipo_vehiculo_id_tipo=$request->get('tipo_vehiculo_id_tipo');
        $tarifa->valor=$request->get('valor');  
        $tarifa->fecha_inicio=$request->get('fecha_inicio'); 
        $tarifa->fecha_fin=$request->get('fecha_fin');
        $tarifa->update();
        return Redirect::to('tarifa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles('admin');

        $tarifa=Tarifa::findOrFail($id);
        $tarifa->delete();
        return Redirect::to('tarifa');;
    }
}
