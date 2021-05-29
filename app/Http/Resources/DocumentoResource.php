<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentoResource extends JsonResource
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
            "id"=>$this->id,
            "nombre"=>$this->nombre,
            "extension archivo"=>$this->extension,
            "ruta"=>$this->ruta ,
            "tamaño del documento"=> $this->tamanio,
            "detalle"=>$this->detalle ,
            "usuario"=>$this->user->name,
            "fecha de creacion"=>$this->created_at ,

        ];
    }
}
