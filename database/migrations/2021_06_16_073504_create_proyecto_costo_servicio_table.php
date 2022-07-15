<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class  CreateProyectoCostoServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_costo_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('servicio_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->enum('forma_pago',
            ['Diaria','Semanal','Quincenal','Mensual']);
            $table->enum('medio_pago',[
                'Efectivo','Transferencia','Credito','Otro'
            ]);
            $table->string('otro_medio_pago')->nullable();
            $table->enum('pago_a_realizar',[
                'Esercon','Proveedor'
            ]);
            $table->timestamps();

            $table->foreign('servicio_id')->on('servicios')->references('id');
            $table->foreign('proveedor_id')->on('proveedores')->references('id');
            $table->foreign('proyecto_id')->on('proyectos')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyecto_costo_servicio');
    }
}
