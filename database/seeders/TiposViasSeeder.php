<?php

namespace Database\Seeders;

use App\Models\TipoMaterial;
use App\Models\TipoVia;
use Illuminate\Database\Seeder;

class TiposViasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoVia::create([
            'nombre'=>'Pavimentada',
            'descripcion'=>''
        ]);
        TipoVia::create([
            'nombre'=>'Destapada',
            'descripcion'=>''
        ]);
        TipoVia::create([
            'nombre'=>'Trocha',
            'descripcion'=>''
        ]);
        TipoVia::create([
            'nombre'=>'otros',
            'descripcion'=>''
        ]);
        #tipo material

        TipoMaterial::create([
            'nombre'=>'Relleno',
            'descripcion'=>''
        ]);
         TipoMaterial::create([
             'nombre'=>'Excavacion',
             'descripcion'=>''
         ]);
        TipoMaterial::create([
            'nombre'=>'Interno',
            'descripcion'=>''
        ]);
        TipoMaterial::create([
            'nombre'=>'Otros',
            'descripcion'=>''
        ]);

    }
}
