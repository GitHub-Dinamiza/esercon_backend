<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class clasificacion_ubicacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'clasificacion_ubicacions';

    protected $fillable = ['nombre'];

    public $timestamps = false;
}
