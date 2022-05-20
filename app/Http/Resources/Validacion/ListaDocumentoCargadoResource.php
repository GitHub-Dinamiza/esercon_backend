<?php

namespace App\Http\Resources\Validacion;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaDocumentoCargadoResource extends JsonResource
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
           'general_data_id'=>$this->tipo_archivo_id
       ];
    }
}
