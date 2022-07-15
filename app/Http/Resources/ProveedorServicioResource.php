<?php

namespace App\Http\Resources;

use App\Models\Provedores\DocumentoProveedor;
use Illuminate\Http\Resources\Json\JsonResource;

class ProveedorServicioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $documento = DocumentoProveedor::where('proveedor_id',$this->proveedor_id)->first();
        return [
            "proveedor_servicio_id"=>$this->id
            ,"proveedor_id"=>$this->proveedor_id
            ,"proveedor"=>$this->proveedor->razon_social
            ,"documento"=>$documento->numero
            ,"tipo_documento"=>$documento->tipoDocumento->codigo


        ];
    }
}
