<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecorridoUbicacionProyecto extends Model
{
    use HasFactory;

    protected $table ='recorrido_ubicacion_proyectos';

    protected $fillable = [
                           'proyecto_id',
                           'recorrido_inicio_id',
                           'recorrido_final_id',
                           'accion_id',
                           'user_id'
                        ];
}
