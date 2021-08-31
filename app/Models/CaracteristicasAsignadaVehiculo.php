<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaracteristicasAsignadaVehiculo extends Model
{
    use HasFactory;

    protected $table = 'caracteristicas_asignada_vehiculos';

    protected $fillable = ['vehiculo_id','caracteristica_vehiculo_id','estado','detalle'];

    public function vehiculo(){
        return $this->belongsTo(Vehiculos::class,'vehiculo_id');
    }

    public function caracteristica(){
        return $this->belongsTo(CarecteristicaVehiculo::class, 'caracteristica_vehiculo_id');
    }
}
