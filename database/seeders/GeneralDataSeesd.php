<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralDataSeesd extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data =[
            [
                'name'=>'rut',
                'slug'=>'',
                'table_iden'=>'prov_tipo_documento'
            ],
            [
                'name'=>'nit',
                'slug'=>'',
                'table_iden'=>'prov_tipo_documento'
            ],
            [
                'name'=>'C.C',
                'slug'=>'',
                'table_iden'=>'prov_tipo_documento'
            ],
            [
                'name'=>'Camara  de comercio',
                'slug'=>'',
                'table_iden'=>'prov_tipo_documento'
            ],

            ###Marca vehiculo.

            [
                'name'=>'Mack',
                'slug'=>'',
                'table_iden'=>'Marca_vehiculos'
            ],

            [
                'name'=>'Autocar',
                'slug'=>'',
                'table_iden'=>'Marca_vehiculos'
            ],

            [
                'name'=>'Checrolet',
                'slug'=>'',
                'table_iden'=>'Marca_vehiculos'
            ],

        ];

        foreach ($data as $index => $d){
            DB::insert('insert into general_data (name, slug, table_iden) values (?, ?, ?)', [$d["name"], $d["slug"], $d["table_iden"]]);
        }
    }
}
