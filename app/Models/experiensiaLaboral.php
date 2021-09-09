<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class experiensiaLaboral extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='experiensia_laboral';

    protected $fillable = [

        'empresa','fecha_inicio','fecha_fin',
        'nombre_contacto','numero_contacto',
        'persona_id'
    ];
}
