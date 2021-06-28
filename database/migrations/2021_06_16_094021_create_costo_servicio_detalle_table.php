<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostoServicioDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costo_servicio_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_costo_servico_id');
            $table->unsignedBigInteger('tipo_costo_servicio_id');
            $table->float('valor');
            $table->timestamps();

            $table->foreign('proyecto_costo_servico_id')
                ->on('proyecto_costo_servicio')
                ->references('id');
            $table->foreign('tipo_costo_servicio_id')
                ->on('tipo_costo_servicio')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costo_servicio_detalle');
    }
}
