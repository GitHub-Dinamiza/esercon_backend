<?php

namespace App\Models\AsignacionRecurso;

use App\Models\Persona\Conductor;
use App\Models\Vehiculo\Vehiculos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionConductor extends Model
{
    use HasFactory;

    protected $table = 'conductor_asignado_vehiculo';
    protected $fillable = ['vehiculo_id',
                            'conductor_id',
                            'comentario',
                            'state'];
    public  function vehiculo(){
        return $this->belongsTo(Vehiculos::class, 'vehiculo_id');
    }

    public function conductor(){
        return $this->belongsTo(Conductor::class, 'conductor_id');
    }
}
