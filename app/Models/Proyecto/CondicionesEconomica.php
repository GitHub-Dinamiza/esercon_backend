<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CondicionesEconomica extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'condiciones_economicas';

    protected $fillable = [
        'nombre_condicion_economica_id',
        'proyecto_id',
        'forma_pago',
        'medio_pago',
        'pago_a_realizar'];

    public function nombreCondicionesEconomica(){
        return $this->belongsTo(NombreCondicionesEconomica::class,'nombre_condicion_economica_id');
     }
}

