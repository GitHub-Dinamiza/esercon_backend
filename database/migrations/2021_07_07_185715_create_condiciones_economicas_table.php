<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondicionesEconomicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condiciones_economicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nombre_condicion_economica_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->enum('forma_pago', ['Diaria','Semanal','Quincenal','Mensual']);
            $table->enum('medio_pago',['Efectivo','Transferencia','Credito','Otros']);
            $table->enum('pago_a_realizar',['Esercon','Proveedor']);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('nombre_condicion_economica_id')
                ->on('nombre_condiciones_economicas')
                ->references('id');
            $table->foreign('proyecto_id')
                ->on('proyectos')
                ->references('id');

            $table->unique(['nombre_condicion_economica_id','proyecto_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condiciones_economicas');
    }
}
