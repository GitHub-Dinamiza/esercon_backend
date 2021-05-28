<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proyectos';

    protected $fillable = [
        'codigo',            'nombre',             'fecha_inicio',
        'fecha_fin',         'municipio_inicio_id','ubicacion_inicial',
        'municipio_final_id','ubicacion_final',    'horas_laboral_dia',
        'temperatura',       'estado',             'user_id'
    ];

    public function proveedor(){

    }

    public function archivos(){
       return $this->hasMany(ArchivoProyecto::class);
    }


}
