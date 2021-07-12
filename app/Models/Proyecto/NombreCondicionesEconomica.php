<?php

namespace App\Models\Proyecto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NombreCondicionesEconomica extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $table = 'nombre_condiciones_economicas';

    protected $fillable =['nombre'];
    public $timestamps =false;


}
