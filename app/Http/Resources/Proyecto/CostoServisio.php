<?php

namespace App\Http\Resources\Proyecto;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class CostoServisio extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
                $cost = $this->costoServicioDetalle;

       //return parent::toArray($request);
       return [
                    'id'=> $this->id,
                    'servicio_id'=>$this->servicio_id,
                    'proveedor_id'=> $this->proveedor_id,
                    'proyecto_id'=> $this->proyecto_id,
                    'forma_pago'=> $this->forma_pago,
                    'medio_pago'=> $this->medio_pago,
                    'otro_medio_pago'=>$this->otro_medio_pago,
                    'pago_a_realizar'=> $this->pago_a_realizar,
                    'created_at'=> $this->created_at,
                    'updated_at'=> $this->updated_at,
                    'detalle'=> CostoServicioDetalle::Collection(
                        $cost
                                          )
        ];
    }
}
