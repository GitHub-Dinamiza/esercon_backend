<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GastoEstimadoProyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'gasto_estimado_proyecto';
    protected $fillable = ['proyecto_id','gasto_estimado_operaciones_id','valor','user_id'];

    public function gastoEstimadoO(){
        return $this->hasMany(GastoEstimadoOperaciones::class);
    }

}
