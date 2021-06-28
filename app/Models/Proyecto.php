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

    public function municipioInicial(){
        return $this->belongsTo(Municipio::class,'municipio_inicio_id');
    }
    public function municipioFinal(){
        return $this->belongsTo(Municipio::class,'municipio_final_id');
    }
    public function archivos(){
       return $this->hasMany(ArchivoProyecto::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public  function tipoVia(){
        return $this->belongsToMany(TipoVia::class,
            'tipos_vias_proyecto',
            'proyecto_id',
            'tipo_via_id');
    }

    public  function tipoMaterial(){
        return $this->belongsToMany(TipoMaterial::class,
            'tipos_materiales_proyecto',
            'proyecto_id',
            'tipo_material_id',
        );
    }
}
