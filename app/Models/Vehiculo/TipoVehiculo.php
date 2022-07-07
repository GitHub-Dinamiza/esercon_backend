<?php

namespace App\Models\Vehiculo;

use App\Models\GeneralData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'tipo_vehiculo';

    protected $fillable = ['marca_id', 'modelo', 'anio_fabricacion'];

    public function marcaVehiculo(){
        return $this->belongsTo(GeneralData::class, 'marca_id');
    }






}
