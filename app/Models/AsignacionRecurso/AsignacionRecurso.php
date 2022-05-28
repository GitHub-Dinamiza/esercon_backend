<?php

namespace App\Models\AsignacionRecurso;

use App\Models\Proyecto;
use App\Models\Vehiculos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsignacionRecurso extends Model
{
    use HasFactory;
    protected $table ='asignacion_recurso_proyecto';
    protected $fillable = ['proyecto_id','vehiculo_id','state'];

    public function proyecto(){
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
    public function vehiculo(){
        return $this->belongsTo(Vehiculos::class, 'vehiculo_id');
    }
}
