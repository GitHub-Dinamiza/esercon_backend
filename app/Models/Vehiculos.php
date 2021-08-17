<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculos extends Model
{
    use HasFactory;

    protected $table ='vehiculos';
    protected $fillable= [
        'placa','tipo_vehiculo_id', 'capacidad_volco_m3','proveedor_id',
        'propietario','tiene_zorro', 'capacidad_zorro'
    ];
}
