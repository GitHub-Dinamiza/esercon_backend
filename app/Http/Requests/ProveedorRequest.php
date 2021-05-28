<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
            'codigo'=>'required',
            'razon_social'=>'required',
            'primer_nombre'=>'',
            'segundo_nombre'=>'',
            'primer_apellido'=>'',
            'segundo_apellido'=>'',
            'tipo_proveedor'=>'required',
            'direccion'=>'',
            'telefono'=>'required',
            'email'=>'required',
            'municipio_id'=>'required|min:1',
        ];
    }
}
