<?php

namespace App\Http\Requests\Proyecto;

use Illuminate\Foundation\Http\FormRequest;

class CreateUbicacionRequest extends FormRequest
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
            'nombre'=>'required|unique:recorrido_proyectos,nombre',
            'direccion'=>'required',
            'municipio_id'=>'required|integer|exists:municipios,id',
            'clasificacion'=>'required|integer|exists:clasificacion_ubicacions,id'
        ];
    }
}
