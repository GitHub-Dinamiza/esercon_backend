<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoViaProyecto extends Model
{
    use HasFactory;

    protected $dates = ['deleted_at'];

    protected $table = 'tipos_vias_proyecto';

    protected $fillable =['tipo_via_id','proyecto_id'];

    protected $hidden = ['created_at','updated_at'];
}
