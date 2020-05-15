<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vehiculo;
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
    $request->user()->authorizeRoles(['admin','emple']);
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $vehiculos=DB::table('vehiculos as ve')
            ->join('tipo_vehiculos as tv','tv.id_tipo','=','ve.tipo_vehiculos_id_tipo')
            ->select('tv.nombre','tv.descripcion','ve.id_vehiculo',
            've.placa','ve.tipo_vehiculos_id_tipo')
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
        $request->user()->authorizeRoles(['admin','emple']);

        $tipo_vehiculo=DB::table('tipo_vehiculos')
        ->get();

        $idvehiculo = DB::table('vehiculos')->max('id_vehiculo');
        if ($idvehiculo==0) {
          $idvehiculo=1;
        }else {
          $idvehiculo = $idvehiculo+1;
        }

        return view ('Vehiculo.create',["tipo_vehiculo"=>$tipo_vehiculo, "idvehiculo"=>$idvehiculo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoFormRequest $request)
    {    
        $ciclo=$request->placa; //Guardo el valor del nombre, por medio del formulario

        $existencia = DB::table('vehiculos')   
        ->select('placa')
        ->where('placa', '=', $ciclo)
        ->get(); //realizo la sentencia para saber si existe
    
       if (count($existencia) >= 1) {   //aqui valido si son iguales en el campo de la db y 

            echo    "<script>
                        alert('No puedes registrar dos veces la misma placa');
                        window.location.href = 'vehiculo/create';
                    </script>";
            exit;
    
        }else{
            $vehiculo=new Vehiculo;
            $vehiculo->id_vehiculo=$request->get('id_vehiculo');
            $vehiculo->tipo_vehiculos_id_tipo=$request->get('tipo_vehiculos_id_tipo'); 
            $vehiculo->placa=$request->get('placa');
            $vehiculo->save();
            //return Redirect::to('vehiculo');
            echo    "<script>
                        alert('Vehiculo Registrado');
                        window.location.href = 'vehiculo';
                    </script>";
            exit;
        }
        
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

        $vehiculo=Vehiculo::findOrFail($id);

        $tipovehiculo=DB::table('tipo_vehiculos')
        ->get();    

        return view("Vehiculo.edit",["vehiculo"=>$vehiculo,"tipovehiculo"=>$tipovehiculo]);
        
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
        $vehiculo->tipo_vehiculos_id_tipo=$request->get('tipo_vehiculos_id_tipo'); 
        $vehiculo->placa=$request->get('placa'); 
        $vehiculo->update();
       //return Redirect::to('vehiculo');
        echo    "<script>
                    alert('Vehiculo Actualizado');
                    window.location.href = '/vehiculo';
                </script>";
        exit;
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

        $vehiculo=Vehiculo::findOrFail($id);
        $vehiculo->delete();
        //return Redirect::to('vehiculo');
        echo    "<script>
                    alert('Vehiculo Eliminado');
                    window.location.href = '/vehiculo';
                </script>";
        exit;
    }
}
