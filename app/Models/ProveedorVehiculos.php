<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedorVehiculos extends Model
{
    use HasFactory;

    protected $table ='proveedor_vehiculos';

    protected $fillable =['proveedor_id', 'municipio_id'];

    public function proveedor(){

        return $this->hasOne(proveedor::class, 'proveedor_id');
    }
}
