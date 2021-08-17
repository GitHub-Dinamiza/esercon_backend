<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class CreateProveedorRequest extends FormRequest
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
            'razon_social'=>'',
            'primer_nombre'=>'required',
            'primer_apellido'=>'required',
            'segundo_nombre'=>'required',
            'segundo_apellido'=>'required',
            'tipo_proveedor'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'email'=>'required',
            'municipio_id'=>'required|exists:municipios,id',
            'numero'=>'required|integer|unique:documentos_proveedores,numero',
            'tipodocumento_id'=>'required|exists:tipos_documentos,id',
            'proveedor_vehiculo'=>'boolean',
            'ciudad_proveedor_vehiculo_id'=>'required_if:proveerdor_vehiculo,true'

        ];
    }
}
