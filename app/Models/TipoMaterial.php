<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMaterial extends Model
{
    use HasFactory;

    protected $fillable =['nombre','descripcion'];

    protected $table = 'tipos_materiales';

    public $timestamps = false;
}
