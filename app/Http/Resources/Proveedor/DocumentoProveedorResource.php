<?php

namespace App\Http\Resources\Proveedor;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentoProveedorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $d =$this->tipoDocumento;
        return [
            'numero'=>$this->numero,
            'tipo_documento'=>$this->tipoDocumento->descripcion_corta,
            'siglas'=>$this->tipoDocumento->codigo
        ];
    }
}
