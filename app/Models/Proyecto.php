<?php

namespace App\Models;

use App\Models\Proyecto\CondicionesEconomica;
use App\Models\Proyecto\GastoEstimadoOperaciones;
use App\Models\Proyecto\GastoEstimadoProyecto;
use App\Models\Proyecto\RecorridoUbicacionProyecto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proyectos';

    protected $fillable = [
         'codigo', 'nombre',             'fecha_inicio',
        'fecha_fin',              'municipio_inicio_id','ubicacion_inicial',
        'municipio_final_id',     'ubicacion_final',    'horas_laboral_dia',
        'temperatura',            'estado',             'user_id',
        'propietario_dobletroque', 'duracion_dias',     'cantidad_vehiculo_propio',
        'cantidad_vehiculo_alquilado',
        'valor_metrocubico_propio',
        'valor_metrocubico_alquilado',
        'valor_contrato',
        'valor_anticipo_contrato',
        'antiguedad_vehiculos_anios',
        'otro_requerimientos'

    ];
### Relacion
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
            'tipo_via_id')->withPivot('otros');
    }

    public  function tipoMaterial(){
        return $this->belongsToMany(TipoMaterial::class,
            'tipos_materiales_proyecto',
            'proyecto_id',
            'tipo_material_id',
        )->withPivot('otros');
    }
   public function  servicioCosto(){
        return $this->hasMany(ProyectoCosto::class);
   }

   public function condicionesEconomicas(){
       return $this->hasMany(CondicionesEconomica::class);
   }

   public function gastoEstimado(){
        return $this->hasMany(GastoEstimadoProyecto::class);

   }

   public function datosAdministivos(){

   }

   public function recorrido (){

       return $this->hasMany(RecorridoUbicacionProyecto::class);
   }
}
