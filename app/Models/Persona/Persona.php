<?php

namespace App\Models\Persona;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'personas';

    protected $fillable = [
        'primer_nombre','segundo_nombre',
        'primer_apellido', 'segundo_apellido',
        'tipo_documento_id','numero_documento',
        'ciudad_residencia_id','direccion',
        'telefono','email','estado_civil',
        'tipo_sangle_id','eps_id',
        'arl_id','estado'
    ];

}
