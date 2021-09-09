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

            [
                'name'=>'Referencia personales',
                'slug'=>'Referencias',
                'table_iden'=>'tipo_archivo'
            ],

            [
                'name'=>'Referencia comercial',
                'slug'=>'Referencias',
                'table_iden'=>'tipo_archivo'
            ],

            [
                'name'=>'Otra referencia',
                'slug'=>'Referencias',
                'table_iden'=>'tipo_archivo'
            ],
            [
                'name'=>'Certificado bancario',
                'slug'=>'Informacio Bancaria',
                'table_iden'=>'tipo_archivo'
            ],
            [
                'name'=>'Cedula',
                'slug'=>'Soporte legales',
                'table_iden'=>'tipo_archivo'
            ],
            [
                'name'=>'Camara de comercio',
                'slug'=>'Soporte legales',
                'table_iden'=>'tipo_archivo'
            ],
            [
                'name'=>'Estado finaciero',
                'slug'=>'Soporte legales',
                'table_iden'=>'tipo_archivo'
            ],
            [
                'name'=>'Rut(DIAN)',
                'slug'=>'Soporte legales',
                'table_iden'=>'tipo_archivo'
            ],
            [
                'name'=>'Nueva eps',
                'slug'=>'',
                'table_iden'=>'eps'
            ],
            [
                'name'=>'Sura',
                'slug'=>'',
                'table_iden'=>'eps'
            ],
            [
                'name'=>'Mutualser',
                'slug'=>'',
                'table_iden'=>'eps'
            ],
            [
                'name'=>'sura arl',
                'slug'=>'',
                'table_iden'=>'arl'
            ],
            [
                'name'=>'O+',
                'slug'=>'',
                'table_iden'=>'tipo_sangle'
            ],
            [
                'name'=>'O-',
                'slug'=>'',
                'table_iden'=>'tipo_sangle'
            ],
            [
                'name'=>'A+',
                'slug'=>'',
                'table_iden'=>'tipo_sangle'
            ],
            [
                'name'=>'A-',
                'slug'=>'',
                'table_iden'=>'tipo_sangle'
            ],
            [
                'name'=>'AB+',
                'slug'=>'',
                'table_iden'=>'tipo_sangle'
            ],
            [
                'name'=>'AB-',
                'slug'=>'',
                'table_iden'=>'tipo_sangle'
            ],

            [
                'name'=>'Hoja de vida',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ],
            [
                'name'=>'Certificado manejo defensivo',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ],
            [
                'name'=>'Certificado primeros Aux',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ],

            [
                'name'=>'Examenes medicos',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ],
            [
                'name'=>'Certificado mecanica básica',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ],
            [
                'name'=>'Registros de vacunas',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ], [
                'name'=>'Prueba covib-19',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ],
            [
                'name'=>'ONAC',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_conductor'
            ],

            [
                'name'=>'Soltero(a)',
                'slug'=>'',
                'table_iden'=>'estado_civil'
            ],
            [
                'name'=>'Casado(a)',
                'slug'=>'',
                'table_iden'=>'estado_civil'
            ],
            [
                'name'=>'Divorciado(a)',
                'slug'=>'',
                'table_iden'=>'estado_civil'
            ],
            [
                'name'=>'Union libre',
                'slug'=>'',
                'table_iden'=>'estado_civil'
            ],
            [
                'name'=>'Activo',
                'slug'=>'',
                'table_iden'=>'estado'
            ],
            [
                'name'=>'Inactivo',
                'slug'=>'',
                'table_iden'=>'estado'
            ],
            [
                'name'=>'Inactivo_documentos',
                'slug'=>'',
                'table_iden'=>'estado'
            ],
            [
                'name'=>'Nombre del propetario',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_vehiculo'
            ],

            [
                'name'=>'SOAT',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_vehiculo'
            ],
            [
                'name'=>'Revision tecnomecanica',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_vehiculo'
            ],
            [
                'name'=>'Seguro contra todo riesgo',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_vehiculo'
            ],
            [
                'name'=>'GPS',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_vehiculo'
            ],
            [
                'name'=>'Certificado de extintor',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_vehiculo'
            ],
            [
                'name'=>'Hoja de mantenimento',
                'slug'=>'',
                'table_iden'=>'tipo_archivo_vehiculo'
            ],

        ];

        foreach ($data as $index => $d){
            DB::insert('insert into general_data (name, slug, table_iden) values (?, ?, ?)', [$d["name"], $d["slug"], $d["table_iden"]]);
        }
    }
}
