<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccionRecorrido extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'accion_recorrido';
    protected $fillable = ['nombre'];

    public $timestamps = false ;


}
