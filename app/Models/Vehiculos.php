<?php

namespace App\Models;

use App\Models\Vehiculo\TipoVehiculo;
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

    public function modelo(){
        return $this->belongsTo(TipoVehiculo::class, 'tipo_vehiculo_id');
    }

    public function proveedor(){
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function asignacionCarateristica(){

        return  $this->hasMany(CaracteristicasAsignadaVehiculo::class,'vehiculo_id');
    }
}
