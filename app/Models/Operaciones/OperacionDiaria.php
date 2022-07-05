<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperacionDiaria extends Model
{
    use HasFactory;

    protected $table = 'operaciones_diaria';

    protected $fillable = ['vehiculo_id','proyecto_id','tipo_materiales'
                            ,'carga_fecha' ,'carga_hora','carga_lugar_id'
                            ,'carga_metrocubicos','carga_kilometraje','desc_fecha'
                            ,'desc_hora','desc_lugar_id','desc_metrocubicos','desc_kilometraje'
                            ,'estdo_id'
    ];


}
