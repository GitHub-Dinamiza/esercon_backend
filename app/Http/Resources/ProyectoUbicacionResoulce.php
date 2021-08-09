<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProyectoUbicacionResoulce extends JsonResource
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
            'direccion'=>$this->direccion,
            'municipio_id'=>$this->municipio_id,
            'municipio'=>$this->municipio->nombre,
            'departamento_id'=>$this->municipio->departamento->id,
            'departamento'=>$this->municipio->departamento->nombre,
            'clasificacion_id'=>$this->clasificacion_id,
            'clasificacion'=>$this->clasificacion->nombre,
        ];
    }
}
