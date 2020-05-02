<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tipo_Vehiculo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Tipo_VehiculoFormRequest;
use DB;

class Tipo_VehiculoController extends Controller
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
            $tipos_vehiculos=DB::table('tipo_vehiculos')
            ->where('tipo_vehiculos.nombre','LIKE','%'.$query.'%')
            ->orderBy('tipo_vehiculos.id_tipo','desc')
            ->paginate(5);
            return view('Tipo_Vehiculo.index',["tipos_vehiculos"=>$tipos_vehiculos,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles('admin');

        $idtipo = DB::table('tipo_vehiculos')->max('id_tipo');
        if ($idtipo==0) {
          $idtipo=1;
        }else {
          $idtipo = $idtipo+1;
        }

        return view ('Tipo_Vehiculo.create',["idtipo"=>$idtipo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Tipo_VehiculoFormRequest $request)
    {    
        $ciclo=$request->nombre; //Guardo el valor del nombre, por medio del formulario

        $existencia = DB::table('tipo_vehiculos')   
        ->select('id_tipo')
        ->where('nombre', '=', $ciclo)
        ->get(); //realizo la sentencia para saber si existe
    
       if (count($existencia) >= 1) {   //aqui valido si son iguales en el campo de la db y 

            echo    "<script>
                        alert('No puedes registrar dos veces el nombre del tipo de vehiculo');
                        window.location.href = 'tipo_vehiculo/create';
                    </script>";
            exit;
    
        }else{
    
            $tipo_vehiculo=new Tipo_Vehiculo;
            $tipo_vehiculo->id_tipo=$request->get('id_tipo');
            $tipo_vehiculo->nombre=$request->get('nombre');
            $tipo_vehiculo->descripcion=$request->get('descripcion'); 
            $tipo_vehiculo->save();
            //return Redirect::to('tipo_vehiculo');
            echo    "<script>
                        alert('Tipo De Vehiculo Registrado');
                        window.location.href = 'tipo_vehiculo';
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
    public function edit($id)
    {
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
    public function update(Tipo_VehiculoFormRequest $request, $id)
    {
        $tipo_vehiculo = Tipo_Vehiculo::findOrFail($id);
        $tipo_vehiculo->id_tipo=$request->get('id_tipo');
        $tipo_vehiculo->nombre=$request->get('nombre');
        $tipo_vehiculo->descripcion=$request->get('descripcion');  
        $tipo_vehiculo->update();
        return Redirect::to('tipo_vehiculo');
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

        $tipo_vehiculo=Tipo_Vehiculo::findOrFail($id);
        $tipo_vehiculo->delete();
        return Redirect::to('tipo_vehiculo');;
    }
}
