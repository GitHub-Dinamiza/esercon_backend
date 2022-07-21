<?php

namespace App\Models\Operaciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehItemRevisionModel extends Model
{
    use HasFactory;
    protected $table = 'veh_item_revision';

    protected $fillable =['nombre','tipo_dato'];




}
