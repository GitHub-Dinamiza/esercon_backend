<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchivoProyecto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected  $fillable = [
        'nombre','extension','ruta',
        'tamanio','detalle','proceso_id',
        'proyecto_id','user_id'
    ];
    protected $table = 'archivos_proyecto';

    public function proyecto(){
        $this->belongsTo(Proyecto::class);
    }
}
