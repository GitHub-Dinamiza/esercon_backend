<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GastoEstimadoOperaciones extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'gasto_estimado_operativo';
    protected $fillable = ['nombre','tipo_dato'];

    public $timestamps = false;

    public function scopeDatosOperativos($query){
        return $query->where('tipo_dato','GO');
    }

    public function scopeDatosAdministrativos($query){
        return $query->where('tipo_dato','GA');
    }
}
