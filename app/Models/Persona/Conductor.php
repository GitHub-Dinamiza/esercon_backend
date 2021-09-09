<?php

namespace App\Models\Persona;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conductor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='conductors';

    protected $fillable = ['persona_id', 'proveedor_id', 'estado'];
}
