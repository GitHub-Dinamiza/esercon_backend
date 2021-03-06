<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarecteristicaVehiculo extends Model
{
    use HasFactory;

    protected $table  = 'carecteristica_vehiculos';

    protected $fillable = ['nombre', 'tipo_dato'];
}
