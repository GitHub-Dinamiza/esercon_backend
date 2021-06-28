<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoCostoServicio extends Model
{
    use HasFactory, SoftDeletes;

    protected  $table ='tipo_costo_servicio';
    protected $fillable = ['nombre','servicio_id'];



}
