<?php

namespace App\Http\Resources\Vehiculo;

use Illuminate\Http\Resources\Json\JsonResource;

class asignacionCarasteristicaVehiculosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
       return [
           $this->caracteristica->nombre=>$this->estado
       ];
    }
}
