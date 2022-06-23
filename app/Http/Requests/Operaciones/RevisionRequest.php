<?php

namespace App\Http\Requests\Operaciones;

use Illuminate\Foundation\Http\FormRequest;

class RevisionRequest extends FormRequest
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
            'vehiculo_id'=>'required',
            'fecha_revision'=>'required',
            'hora'=>'required',
           // 'encendido'=>'array:valor, required',
           // 'encendido'=>'array:comentario, required',
            'encendido'=>[
                'valor'=>'required',
               'comentario'=>'required',
            ],
            'parabrisa_delantero'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'parabrisa_trasero'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'retrovisor_izquiesdo'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'retrovisor_derecho'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'Vidrio_puerta_Derecha'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'Vidrio_Puerta_Izquierdo'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'Corneta'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'Aire_Acondicionado'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'Aceite'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'Refrigerante'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ],
            'Sistemas_Hidraulico'=>[
                 'valor'=>'required',
                'comentario'=>'required'
            ]

        ];
    }
}
