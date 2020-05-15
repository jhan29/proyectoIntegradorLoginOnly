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
            $tarifas=DB::table('tarifa_vehiculos')
            ->where('tarifa_vehiculos.valor_hora','LIKE','%'.$query.'%')
            ->orderBy('tarifa_vehiculos.id_tarifa','desc')
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

        $idtarifa = DB::table('tarifa_vehiculos')->max('id_tarifa');
        if ($idtarifa==0) {
          $idtarifa=1;
        }else {
          $idtarifa = $idtarifa+1;
        }

        $idtipovehiculo=DB::table('tipo_vehiculos')
        ->whereNotIn('tipo_vehiculos.id_tipo', function($query){
        $query -> select('tarifa_vehiculos.tipo_vehiculos_id_tipo')
        ->from('tarifa_vehiculos')
        ->where('tarifa_vehiculos.estado','=','Activo');
    })
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
        $tarifa->tipo_vehiculos_id_tipo=$request->get('tipo_vehiculos_id_tipo');
        $tarifa->valor_hora=$request->get('valor_hora');
        $tarifa->estado=$request->get('estado'); 
        $tarifa->save();
        //return Redirect::to('tarifa');
        echo    "<script>
                    alert('Tarifa Registrada');
                    window.location.href = 'tarifa';
                </script>";
        exit;
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

        $tipovehiculo = DB::table('tipo_vehiculos')
        ->get();

        $tarifa=Tarifa::findOrFail($id);

        return view("Tarifa.edit",["tarifa"=>$tarifa, "tipovehiculo"=>$tipovehiculo]);
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
        $tarifa->tipo_vehiculos_id_tipo=$request->get('tipo_vehiculos_id_tipo');
        $tarifa->valor_hora=$request->get('valor_hora');  
        $tarifa->estado=$request->get('estado'); 
        $tarifa->update();
        //return Redirect::to('tarifa');
        echo    "<script>
                    alert('Tarifa Actualizada');
                    window.location.href = '/tarifa';
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

        $tarifa=Tarifa::findOrFail($id);
        $tarifa->estado ='Inactivo';
        $tarifa->update();
        //return Redirect::to('tarifa');
        echo    "<script>
                    alert('Estado De La Tarifa Se Modifico Con Exito');
                    window.location.href = '/tarifa';
                </script>";
        exit;
    }
}
