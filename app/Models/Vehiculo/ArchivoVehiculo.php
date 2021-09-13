<?php

namespace App\Models\Vehiculo;

use App\Models\GeneralData;
use App\Models\User;
use App\Models\Vehiculos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoVehiculo extends Model
{
    use HasFactory;

    protected $table = 'archivo_vehiculos';

    protected  $fillable = [
                            'nombre',
                            'vehiculo_id',
                            'tipo_archivo_id',
                            'ruta',
                            'extension',
                            'tamanio',
                            'fecha_espedicon',
                            'user_id'
                        ];

    public function tipoArchivo()
    {
        return $this->belongsTo(GeneralData::class, 'tipo_archivo_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
