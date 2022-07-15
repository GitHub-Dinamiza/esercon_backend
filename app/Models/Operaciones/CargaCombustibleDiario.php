<?php

namespace App\Models\Operaciones;

use App\Models\Persona\Conductor;
use App\Models\ProyectoCosto;
use App\Models\Vehiculo\Vehiculos;
use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaCombustibleDiario extends Model
{
    use HasFactory;
     protected $table = 'carga_combustible_diario';

     protected $fillable = [
         'vehiculo_id'
         ,'conductor_id'
         ,'proveedor_servicio_id'
         ,'fecha_registro'
         ,'tipo_combustible'
         ,'valor_galon'
         ,'total_galon'
         ,'user_id'
     ];

     public function vehiculo(){
         return $this->belongsTo(Vehiculos::class,'vehiculo_id');
     }

     public function conductor(){
         return $this->belongsTo(Conductor::class,'conductor_id');
     }

     public function proveedorServicio (){
         return $this->belongsTo(ProyectoCosto::class, 'proveedor_servicio_id');
     }
     public  function allData(){
         return $this->all();
     }
}
