<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarifaFormRequest extends FormRequest
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
            'id_tarifa' => 'required',
            'tipo_vehiculo_id_tipo' => 'required',
            'valor' => 'required|Integer|min:1|digits_between:1,4',
            'fecha_inicio' => 'required',//|date_format:Y-n-j',
            'fecha_fin' => 'required',//|date_format:Y-n-j',
        ];
    }

    public function Messages()
    {
        return [
            'valor.required'   => 'El atributo valor tarifa * hora, es obligatorio.',
            'valor.min'   => 'El atributo valor tarifa * hora, debe contener numeros mayores a 0.',
            'valor.digits_between'   => 'El atributo valor tarifa * hora, debe contener entre 1 a 4 numeros.',

            'id_tarifa.required'   => 'El atributo id tarifa, es obligatorio.',

            'tipo_vehiculo_id_tipo.required'   => 'El atributo tipo vehiculo asignar, es obligatorio.',

            'fecha_inicio.required'   => 'El atributo fecha inicio, es obligatorio.',

            'fecha_fin.required'   => 'El atributo fecha final, es obligatorio.',

        ];
    }
}
