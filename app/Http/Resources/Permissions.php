<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use function PHPUnit\Framework\isNull;

class Permissions extends JsonResource
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
            "name"=>$this->name,
            "slug"=>$this->slug,
            "blocked"=>$this->when(  $this->pivot->role_id, true),


        ];
    }
}
