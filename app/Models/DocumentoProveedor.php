<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentoProveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'documentos_proveedores';

    protected $fillable =[
        'numero','tipodocumento_id','user_id','proveedor_id'
    ];
    public function proveedor(){
        $this->belongsTo(Proveedor::class);
    }
}
