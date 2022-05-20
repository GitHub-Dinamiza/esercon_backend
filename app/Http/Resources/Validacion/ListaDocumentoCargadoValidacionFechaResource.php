<?php

namespace App\Http\Resources\Validacion;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaDocumentoCargadoValidacionFechaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['fecha_expedicon'=>$this->fecha_espedicon];
    }
}
