<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vehiculo;
use App\Cliente;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\VehiculoFormRequest;
use DB;

class VehiculoController extends Controller
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
    $request->user()->authorizeRoles('admin');
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $vehiculos=DB::table('vehiculo as ve')
            ->join('tipo_vehiculo as tv','tv.id_tipo','=','ve.tipo_vehiculo_id_tipo')
            ->select('ta.nombre','ta.descripcion','ve.id_vehiculo',
            've.placa','ve.tipo_vehiculo_id_tipo')
            ->where('ve.placa','LIKE','%'.$query.'%')
            ->orderBy('ve.id_vehiculo','desc')
            ->paginate(5);
            return view('Vehiculo.index',["vehiculos"=>$vehiculos,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('Administrador');

        $clientes=DB::table('cliente as cli')
        ->join('persona as per','per.num_documento','=','cli.num_documento')
        ->select('per.num_documento','per.nombre','per.apellido','cli.id_cliente')
        ->whereNotIn('cli.id_cliente', function($query){
            $query -> select('vehiculo.id_cliente')
        ->from('vehiculo');
         })
        ->get();

        $idvehiculo = DB::table('vehiculo')->max('id_vehiculo');
        if ($idvehiculo==0) {
          $idvehiculo=1;
        }else {
          $idvehiculo = $idvehiculo+1;
        }

        return view ('Vehiculo.create',["clientes"=>$clientes,"idvehiculo"=>$idvehiculo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoFormRequest $request)
    {    
        $vehiculo=new Vehiculo;
        $vehiculo->id_vehiculo=$request->get('id_vehiculo');
        $vehiculo->placa=$request->get('placa');
        $vehiculo->tipo_vehiculo_id_tipo=$request->get('tipo_vehiculo_id_tipo'); 
        $vehiculo->save();
        return Redirect::to('vehiculo');
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

        $tipo=DB::table('tipo_vehiculo as tv')
        ->join('vehiculo as ve','ve.tipo_vehiculo_id_tipo','=','tv.id_tipo')
        ->select('tv.nombre','tv.descripcion','ve.placa','ve.tipo_vehiculo_id_tipo')
        ->get();
        
        $vehiculo=Vehiculo::findOrFail($id);
        return view("Vehiculo.edit",["vehiculo"=>$vehiculo,"tipo"=>$tipo]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VehiculoFormRequest $request, $id)
    {
        $vehiculo=Vehiculo::findOrFail($id);
        $vehiculo->id_vehiculo=$request->get('id_vehiculo');
        $vehiculo->placa=$request->get('placa');
        $vehiculo->tipo_vehiculo_id_tipo=$request->get('tipo_vehiculo_id_tipo'); 
        $vehiculo->update();
        return Redirect::to('vehiculo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $request->user()->authorizeRoles('Administrador');

        $vehiculo=Vehiculo::findOrFail($id);
        $vehiculo->delete();
        return Redirect::to('vehiculo');
    }
}
