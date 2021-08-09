<?php

namespace App\Models\Proyecto;

use App\Models\Municipio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecorridoProyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'recorrido_proyectos';
    protected $fillable = [
        'nombre',
        'direccion',
        'municipio_id',
        'clasificacion_id',
        'user_id'
    ];

    public $timestamps =false;

    public function municipio(){
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function clasificacion(){
        return $this->belongsTo(clasificacion_ubicacion::class, 'clasificacion_id');
    }

}
