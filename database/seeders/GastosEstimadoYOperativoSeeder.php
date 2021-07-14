<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GastosEstimadoYOperativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[
            ['nombre'=>'salario_conductor_dia','tipodato'=>'GA'],
            ['nombre'=>'salario_gerencia_nacional_operaciones_dia','tipodato'=>'GA'],
            ['nombre'=>'salario_gerencia_regional_operaciones_dia','tipodato'=>'GA'],
            ['nombre'=>'salario_gerencia_recursos_humanos_dia','tipodato'=>'GA'],
            ['nombre'=>'salario_asistente_recursos_humanos_dia','tipodato'=>'GA'],
            ['nombre'=>'salario_gerencia_administracion_dia','tipodato'=>'GA'],
            ['nombre'=>'salarios_upervisor_asignado_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_arriendo_oficina_dia','tipodato'=>'GA'],
            ['nombre'=>'pagos_servicios_oficina_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_alojamiento_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_alimentacion_dia','tipodato'=>'GA'],

            ['nombre'=>'pago_alquiler_camionetas_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_tiquetes_aereos_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_transporte_terrestre_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_gasolina_camionetas_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_papeleria_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_insumos_oficina_dia','tipodato'=>'GA'],
            ['nombre'=>'pago_gastos_oficina','tipodato'=>'GA'],



            ['nombre'=>'consumo_combustible_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'consumo_lubricante_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'consumo_refrigerante_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'consumo_grasa' ,'tipodato'=>'GO'],
            ['nombre'=>'consumo_llantas_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'pago_peajes' ,'tipodato'=>'GO'],
            ['nombre'=>'pago_conductor_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'pago_hidratacion_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'pago_llantas_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'pago_soat_dia' ,'tipodato'=>'GO'],
            ['nombre'=>'pago_tecnomecanica_dia','tipodato'=>'GO'],
            ['nombre'=>'pago_seguro_dia','tipodato'=>'GO'],
            ['nombre'=>'pago_leasing_dia','tipodato'=>'GO'],
            ['nombre'=>'pago_lavado_dia','tipodato'=>'GO'],
            ['nombre'=>'pago_mantenimiento_dia','tipodato'=>'GO'],
            ['nombre'=>'pago_admin_dia','tipodato'=>'GO']


        ];

        foreach ($data as $index=>$d){
            DB::insert('insert into gasto_estimado_operativo (nombre, tipo_dato) values (?, ?)', [$d["nombre"], $d["tipodato"]]);
        }
    }
}
