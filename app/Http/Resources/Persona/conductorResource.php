<?php

namespace App\Http\Resources\Persona;

use Illuminate\Http\Resources\Json\JsonResource;

class conductorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [

            'id'=>$this->id,
            'primer_nombre'=>$this->primer_apellido,
            'segundo_nombre'=>$this->segundo_nombre,
            'primer_apellido'=>$this->primer_apellido,
            'segundo_apellido'=>$this->segundo_apellido

        ];
    }
}
