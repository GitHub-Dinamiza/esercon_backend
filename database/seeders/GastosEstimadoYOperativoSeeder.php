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
            ['nombre'=>'Salario conductor por dia','tipodato'=>'GA'],
            ['nombre'=>'S. ger. Nal. Operaciones por dia','tipodato'=>'GA'],
            ['nombre'=>'S. ger. Regional operaciones por dia','tipodato'=>'GA'],
            ['nombre'=>'S. ger. Recursos humanos por dia','tipodato'=>'GA'],
            ['nombre'=>'S. asistente rec humanos por día','tipodato'=>'GA'],
            ['nombre'=>'Salario gerencia administrativa por día','tipodato'=>'GA'],
            ['nombre'=>'Salario supervidor asignado por día','tipodato'=>'GA'],
            ['nombre'=>'Pago arriendo oficina por día','tipodato'=>'GA'],
            ['nombre'=>'Pago servicios oficina por día','tipodato'=>'GA'],
            ['nombre'=>'Pago alojamiento por día','tipodato'=>'GA'],
            ['nombre'=>'Pago alimentación por día','tipodato'=>'GA'],

            ['nombre'=>'Pago alquiler de camionetas por día','tipodato'=>'GA'],
            ['nombre'=>'Pago tiquetes aéreos por día','tipodato'=>'GA'],
            ['nombre'=>'Pago transporte terrestre por día','tipodato'=>'GA'],
            ['nombre'=>'Pago gasolina camionetas por día','tipodato'=>'GA'],
            ['nombre'=>'Pago papelería por día','tipodato'=>'GA'],
            ['nombre'=>'Pago insumos oficina por día','tipodato'=>'GA'],
            ['nombre'=>'Pago otros gastos oficina','tipodato'=>'GA'],


            ['nombre'=>'Consumo de combustible por día','tipodato'=>'GO'],
            ['nombre'=>'Consumo de lubricante por día','tipodato'=>'GO'],
            ['nombre'=>'Consumo de refrigerante','tipodato'=>'GO'],
            ['nombre'=>'Consumo de grasa','tipodato'=>'GO'],
            ['nombre'=>'Consumo de llantas por día','tipodato'=>'GO'],
            ['nombre'=>'Pago de peajes','tipodato'=>'GO'],
            ['nombre'=>'Pago conductor por día','tipodato'=>'GO'],
            ['nombre'=>'Pago de hidratación por día','tipodato'=>'GO'],
            ['nombre'=>'Pago parqueadero por día','tipodato'=>'GO'],
            ['nombre'=>'Pago SOAT por día','tipodato'=>'GO'],
            ['nombre'=>'Pago Tecnomecánica por día','tipodato'=>'GO'],
            ['nombre'=>'Pago de seguro todo riesgo por día','tipodato'=>'GO'],
            ['nombre'=>'Pago cuota leasing por día','tipodato'=>'GO'],
            ['nombre'=>'Pago lavado por día','tipodato'=>'GO'],
            ['nombre'=>'Pago mantenimiento por día','tipodato'=>'GO'],
            ['nombre'=>'Pago Administración por día','tipodato'=>'GO']

        ];

        foreach ($data as $index=>$d){
            DB::insert('insert into gasto_estimado_operativo (nombre, tipo_dato) values (?, ?)', [$d["nombre"], $d["tipodato"]]);
        }
    }
}
