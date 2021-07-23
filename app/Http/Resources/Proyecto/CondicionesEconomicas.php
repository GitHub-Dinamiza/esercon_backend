<?php

namespace App\Http\Resources\Proyecto;

use Illuminate\Http\Resources\Json\JsonResource;

class CondicionesEconomicas extends JsonResource
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
            'nombre_condicion_economica_id'=>$this->nombre_condicion_economica_id,
            'nombre_condicion_economica'=>$this->nombreCondicionesEconomica->nombre,
            'forma_pago'=>$this->forma_pago,
            'medio_pago'=>$this->medio_pago,
            'pago_a_realizar'=>$this->pago_a_realizar

        ];
    }
}
