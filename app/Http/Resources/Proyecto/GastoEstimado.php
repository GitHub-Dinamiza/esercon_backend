<?php

namespace App\Http\Resources\Proyecto;

use Illuminate\Http\Resources\Json\JsonResource;

class GastoEstimado extends JsonResource
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
                    $this->gastoEstimadoO->nombre=>$this->valor,
                    'tipo_dato'=>$this->gastoEstimadoO->tipo_dato
                ];
    }
}
