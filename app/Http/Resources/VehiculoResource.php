<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VehiculoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'id'=>$this->id,
            'placa'=>$this->placa,
            'modelo_vehiculo_id'=>$this->tipo_vehiculo_id,
            'modelo'=>$this->modelo->modelo,
            'marca'=>$this->modelo->marcaVehiculo->name,
            'año_fabricancion'=>$this->modelo->anio_fabricacion,
            'tiene_zorro'=>$this->tiene_zorro,
            'capacidad_zorro'=>$this->capacidad_zorro,
            'capacidad_volco'=>$this->capacidad_volco,
            'proveedor_id'=>$this->proveedor_id,
            'proveedor'=>$this->proveedor->razon_social


        ];
    }
}
