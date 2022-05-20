<?php

namespace App\Http\Resources\Validacion;

use Illuminate\Http\Resources\Json\JsonResource;

class ListaArchivoResource extends JsonResource
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
          'general_data_id'=>$this->general_data_id
        ];
    }
}
