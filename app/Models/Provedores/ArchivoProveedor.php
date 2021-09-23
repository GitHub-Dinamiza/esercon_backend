<?php

namespace App\Models\Provedores;

use App\Models\GeneralData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoProveedor extends Model
{
    use HasFactory;
    protected $fillable = ['nombre',
                           'proveedor_id',
                           'tipo_archivo_id',
                           'ruta',
                           'extension',
                           'tamanio',
                           'user_id'
                        ];

    protected $table ='archivos_proveedores';

    public function generalData(){
        return $this->belongsTo(GeneralData::class,'tipo_archivo_id' );
    }
}
