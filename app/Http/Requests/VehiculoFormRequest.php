<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_vehiculo'=>'required',
            'id_cliente'=>'required',
            'tipo_vehiculo'=>'required|in:Automovil,Motocicleta,Buseta',
            'placa_vehiculo'=>'required|max:6',
            'marca_vehiculo'=>'required|max:20',
            'modelo_vehiculo'=>'required|max:4',
            'color_vehiculo'=>'required|max:15',
            'num_puertas'=>'required|max:1',
        ];
    }

    public function Messages()
    {
        return [
            'id_vehiculo.required'   => 'El atributo vehiculo numero es obligatorio.',

            'id_cliente.required'   => 'El atributo documento del cliente es obligatorio.',
            
            'tipo_vehiculo.required'   => 'El atributo tipo de vehiculo es obligatorio.',
            'tipo_vehiculo.in'        => 'El atributo tipo de vehiculo seleccionado no es valido.',
           
            'placa_vehiculo.required'   => 'El atributo placa del vehiculo es obligatorio.',
            'placa_vehiculo.max'        => 'El atributo placa del vehiculo debe contener maximo de 6 letras y/o numeros.',

            'marca_vehiculo.required'   => 'El atributo marca del vehiculo es obligatorio.',
            'marca_vehiculo.max'        => 'El atributo marca del vehiculo debe contener maximo de 20 letras.',

            'modelo_vehiculo.required'   => 'El atributo modelo del vehiculo es obligatorio.',
            'modelo_vehiculo.max'        => 'El atributo modelo del vehiculo debe contener maximo de 4 numeros.',

            'color_vehiculo.required'   => 'El atributo color del vehiculo es obligatorio.',
            'color_vehiculo.max'        => 'El atributo color del vehiculo debe contener maximo de 15 letras.',

            'num_puertas.required'   => 'El atributo numero de puertas es obligatorio.',
            'num_puertas.max'        => 'El atributo numero de puertas debe contener maximo de 1 numero.',
        ];
    }
}
