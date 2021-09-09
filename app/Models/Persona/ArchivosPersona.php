<?php

namespace App\Models\Persona;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivosPersona extends Model
{
    use HasFactory;

    protected $table ='documentos_personas';

    protected $fillable =[
                            'nombre','persona_id',
                            'tipo_archivo_id','ruta',
                            'extension','tamanio',
                            'fecha_espedicon','user_id'
                        ];
}
