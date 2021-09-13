<?php

namespace App\Http\Resources;

use App\Http\Resources\Vehiculo\ArchivosVehiculosResource;
use App\Http\Resources\Vehiculo\asignacionCarasteristicaVehiculosResource;

use Illuminate\Database\Eloquent\Collection;
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
        $data = new Collection();
        $req = asignacionCarasteristicaVehiculosResource::collection($this->asignacionCarateristica);
        foreach($req as $index=>$d){

            $data = $data->union($d);
        }

        return
        [
            'id'=>$this->id,
            'placa'=>$this->placa,
            'modelo_vehiculo_id'=>$this->tipo_vehiculo_id,
            'modelo'=>$this->modelo->modelo,
            'marca_id'=>$this->modelo->marca_id,
            'marca'=>$this->modelo->marcaVehiculo->name,
            'anio_fabricancion'=>$this->modelo->anio_fabricacion,
            'tiene_zorro'=>$this->tiene_zorro,
            'capacidad_zorro'=>$this->capacidad_zorro,
            'capacidad_volco'=>$this->capacidad_volco_m3,
            'propetario'=>$this->propietario,
            'proveedor_id'=>$this->proveedor_id,
            'proveedor'=>$this->proveedor->razon_social,
            'caracteristicas'=>$data,
            'archivos'=>ArchivosVehiculosResource::collection($this->archivo)


        ];
    }
}
