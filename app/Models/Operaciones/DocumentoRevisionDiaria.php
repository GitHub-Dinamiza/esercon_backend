<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoRevisionDiaria extends Model
{
    use HasFactory;
    protected $table = 'documentos_revision_diaria';

    protected $fillable = [
        'veh_revision_daria_id'
        ,'nombre'
        ,'ruta'
        ,'extension'
        ,'tamanio'
        ,'user_id'
     ];
}
