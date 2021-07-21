<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costoServicioDetalle extends Model
{
    use HasFactory;
   protected $table = 'costo_servicio_detalle';
   protected $fillable =[
       'proyecto_costo_servico_id',
       'tipo_costo_servicio_id',
       'valor'
   ];

   public function  ProyectoCostoServicio(){
       return $this->belongsTo(ProyectoCosto::class);
   }

   public function  tipoCostoServicio(){
       return $this->belongsTo(TipoCostoServicio::class);
   }

}
