<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValidacionDocumentoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('validacion_documentacions')->insert([
            ['documento_id'=>'8'],
            ['documento_id'=>'9'],
            ['documento_id'=>'10'],
            ['documento_id'=>'11'],
            ['documento_id'=>'12'],
            ['documento_id'=>'13'],
            ['documento_id'=>'14'],
            ['documento_id'=>'15'],

            ['documento_id'=>'26'],
            ['documento_id'=>'27'],
            ['documento_id'=>'28'],
            ['documento_id'=>'29'],
            ['documento_id'=>'30'],
            ['documento_id'=>'31'],
            ['documento_id'=>'32'],
            ['documento_id'=>'33'],


            ['documento_id'=>'41'],
            ['documento_id'=>'42'],
            ['documento_id'=>'43'],
            ['documento_id'=>'44'],
            ['documento_id'=>'45'],
            ['documento_id'=>'46'],
            ['documento_id'=>'47'],

        ]);
    }
}
