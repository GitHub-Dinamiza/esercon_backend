<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class modeloVehiculoResource extends JsonResource
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
            'marca'=>$this->marcaVehiculo->name,
            'marca_id'=>$this->marca_id,
            'modelo'=>$this->nodelo,
            'anio_fabricacion'=>$this->anio_fabricacion
        ];
    }
}
