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
        $request->user()->authorizeRoles(['Administrador','Empleado']);
        
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
        $request->user()->authorizeRoles(['Administrador','Empleado']);

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
        $request->user()->authorizeRoles(['Administrador','Empleado']);

        $vehiculos = DB::table('vehiculo as veh')
        ->join('cliente as cli', 'cli.id_cliente','=','veh.id_cliente')
        ->join('persona as per', 'per.num_documento','=','cli.num_documento')
        ->select('cli.id_cliente','cli.num_documento','per.nombre','per.apellido','veh.id_vehiculo','veh.tipo_vehiculo',
        'veh.placa_vehiculo','veh.marca_vehiculo','veh.modelo_vehiculo','veh.color_vehiculo','veh.num_puertas')
        ->get();

        //dd($vehiculos);

        $pdf = \PDF::loadView('Pdf.vehiculosPDF',[
            'vehiculos' => $vehiculos
            ]);
            
            $pdf->setPaper('carta', 'A4');
            return $pdf->download('Listado De Vehiculos.pdf');
    }

    public function imprimirVehiculoEspecifico(Request $request,$id_vehiculo){
        $request->user()->authorizeRoles(['Administrador','Empleado']);

        $vehiculoespecifico = DB::table('vehiculo as veh')
        ->join('cliente as cli', 'cli.id_cliente','=','veh.id_cliente')
        ->join('persona as per', 'per.num_documento','=','cli.num_documento')
        ->select('cli.id_cliente','cli.num_documento','per.nombre','per.apellido','veh.id_vehiculo','veh.tipo_vehiculo',
        'veh.placa_vehiculo','veh.marca_vehiculo','veh.modelo_vehiculo','veh.color_vehiculo','veh.num_puertas')
        ->where('veh.id_vehiculo','=',$id_vehiculo)
        ->get();

        foreach ($vehiculoespecifico as $ve) {
            $idcliente=$ve->id_cliente;
            $numdocumento=$ve->num_documento;
            $nombrecli=$ve->nombre;
            $apellidocli=$ve->apellido;
            $idvehiculo=$ve->id_vehiculo;
            $tipo=$ve->tipo_vehiculo;
            $placa=$ve->placa_vehiculo;
            $marca=$ve->marca_vehiculo;
            $modelo=$ve->modelo_vehiculo;
            $color=$ve->color_vehiculo;
            $numpuertas=$ve->num_puertas;
        }
        //dd($vehiculoespecifico);

        $pdf = \PDF::loadView('Pdf.vehiculoEspecificoPDF',[
            'idcliente' => $idcliente,
            'numdocumento' => $numdocumento,
            'nombrecli' => $nombrecli,
            'apellidocli' => $apellidocli,
            'idvehiculo' => $idvehiculo,
            'tipo' => $tipo,
            'placa' => $placa,
            'marca' => $marca,
            'modelo' => $modelo,
            'color' => $color,
            'numpuertas' => $numpuertas,

            ]);
            
            $pdf->setPaper('carta', 'A4');
            return $pdf->download('Vehiculo Especifico.pdf');
    }
}
