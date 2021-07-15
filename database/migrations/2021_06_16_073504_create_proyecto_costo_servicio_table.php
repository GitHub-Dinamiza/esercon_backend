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
                'Efectivo','Tranferencia','Credito','Otros'
            ]);
            $table->string('otro_medio_pago')->nullable();
            $table->enum('pago_a_realizar',[
                'Esercon','Proveedor'
            ]);
            $table->timestamps();

            $table->foreign('servicio_id')->references('id')->on('servicios');
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');

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
