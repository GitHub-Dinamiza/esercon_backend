<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCostoServicio extends Model
{
    use HasFactory;
    protected $table = 'tipo_costo_servicio';
    protected  $fillable = ['servicio_id','nombre'];
    public $timestamps = false;

    ### relaciones
    public function servicio(){
        return $this->belongsTo();
    }
    public function  costoServicioDetalle(){
        return $this->hasMany(ProyectoCosto::class);
    }

    public function escopeAdd($query, $request){
        $add = $query->create([
            'servicio_id'=>$request->servicio_id,
            'nombre'=>$request->nombre
        ]);
        return response($add);
    }
}
