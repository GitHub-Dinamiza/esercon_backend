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
}
