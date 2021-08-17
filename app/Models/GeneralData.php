<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralData extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug', 'table_iden'];

    protected $table = 'general_data';

    public $timestamps = false;
}
