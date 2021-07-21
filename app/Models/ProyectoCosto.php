<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoCosto extends Model
{
    use HasFactory;

    protected $fillable =[
        'servicio_id','proveedor_id','proyecto_id',
        'forma_pago','medio_pago','otro_medio_pago',
        'pago_a_realizar'
    ];
    protected $table = 'proyecto_costo_servicio';
### Relaciones
    public function  proyecto(){
        return $this->belongsTo(Proyecto::class);
    }

    public function costoServicioDetalle(){
        return $this->hasMany(costoServicioDetalle::class,'proyecto_costo_servico_id');
    }


}
