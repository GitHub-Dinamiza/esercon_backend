<?php

namespace App\Models;

use App\Models\Provedores\Proveedor;
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
        return $this->belongsTo(Proyecto::class, );
    }
    public function  proveedor(){
        return $this->belongsTo(Proveedor::class,'proveedor_id' );
    }
    public function costoServicioDetalle(){
        return $this->hasMany(costoServicioDetalle::class,'proyecto_costo_servico_id');
    }
    public function servicio(){

        return $this->belongsTo(Servicio::class);
    }


}
