<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;
use App\Persona;
use DB;

class PdfController extends Controller
{
    public function imprimirPersonas(Request $request){
        $request->user()->authorizeRoles(['admin','emple']);
        
        $personas = DB::table('persona')
        ->select('persona.num_documento','persona.nombre','persona.apellido','persona.email','persona.contacto')
        ->get();

        $pdf = \PDF::loadView('Pdf.personasPDF',[
            'personas' => $personas,
                ]);

        $pdf->setPaper('carta', 'A4');
        return $pdf->download('Listado De Personas.pdf');
    }

    public function imprimirClientes(Request $request){
        $request->user()->authorizeRoles(['admin','emple']);

        $clientes = DB::table('cliente as cli')
        ->join('persona as per', 'per.num_documento','=','cli.num_documento')
        ->select('cli.id_cliente','cli.num_documento','per.nombre','per.apellido')
        ->get();

        $pdf = \PDF::loadView('Pdf.clientesPDF',[
            'clientes' => $clientes
            ]);

            $pdf->setPaper('carta', 'A4');
            return $pdf->download('Listado De Cliente.pdf');
    }

    public function imprimirVehiculos(Request $request){
        $request->user()->authorizeRoles(['admin','emple']);

        $vehiculos = DB::table('vehiculo as ve')
        ->join('tipo_vehiculo as tv','tv.id_tipo','=','ve.tipo_vehiculo_id_tipo')
        ->select('tv.nombre','ve.tipo_vehiculo_id_tipo','ve.id_vehiculo','ve.placa')
        ->get();

        //dd($vehiculos);

        $pdf = \PDF::loadView('Pdf.vehiculosPDF',[
            'vehiculos' => $vehiculos
            ]);
            
            $pdf->setPaper('carta', 'A4');
            return $pdf->download('Listado De Vehiculos.pdf');
    }

    public function imprimirVehiculoEspecifico(Request $request,$id_vehiculo){
        $request->user()->authorizeRoles(['admin','emple']);

        $vehiculoespecifico = DB::table('vehiculo as ve')
        ->join('tipo_vehiculo as tv','tv.id_tipo','=','ve.tipo_vehiculo_id_tipo')
        ->select('tv.nombre','ve.tipo_vehiculo_id_tipo','ve.id_vehiculo','ve.placa')
        ->where('ve.id_vehiculo','=',$id_vehiculo)
        ->get();

        foreach ($vehiculoespecifico as $ve) {
            $tiponombre=$ve->nombre;
            $tipovehiculoid=$ve->tipo_vehiculo_id_tipo;
            $idvehiculo=$ve->id_vehiculo;
            $placavehiculo=$ve->placa;
        }
        //dd($vehiculoespecifico);

        $pdf = \PDF::loadView('Pdf.vehiculoEspecificoPDF',[
            'tiponombre' => $tiponombre,
            'tipovehiculoid' => $tipovehiculoid,
            'idvehiculo' => $idvehiculo,
            'placavehiculo' => $placavehiculo,
            ]);
            
            $pdf->setPaper('carta', 'A4');
            return $pdf->download('Vehiculo Especifico.pdf');
    }
}
