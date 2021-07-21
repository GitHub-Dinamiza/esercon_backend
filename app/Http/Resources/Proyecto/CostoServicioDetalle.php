<?php

namespace App\Http\Resources\Proyecto;

use Illuminate\Http\Resources\Json\JsonResource;

class CostoServicioDetalle extends JsonResource
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
            'id'=> $this->id,
            'tipo_costo_servicio_id'=> $this->tipo_costo_servicio_id,
            'nombre'=>$this->tipoCostoServicio->nombre,
            'valor' => $this->valor
        ];
    }
}
