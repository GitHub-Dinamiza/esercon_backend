<?php

namespace App\Http\Resources\Proyecto;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoMaterial extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'otros'=>$this->pivot->otros
        ];
    }
}
