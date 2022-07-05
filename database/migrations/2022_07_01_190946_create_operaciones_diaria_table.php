<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperacionesDiariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operaciones_diaria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehiculo_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('tipo_materiales');
            $table->date('carga_fecha');
            $table->time('carga_hora');
            $table->unsignedBigInteger('carga_lugar_id');
            $table->float('carga_metrocubicos');
            $table->integer('carga_kilometraje');

            $table->date('desc_fecha')->nullable();
            $table->time('desc_hora')->nullable();
            $table->unsignedBigInteger('desc_lugar_id')->nullable();
            $table->float('desc_metrocubicos')->nullable();
            $table->integer('desc_kilometraje')->nullable();

            $table->unsignedBigInteger('estdo_id');

            $table->foreign('vehiculo_id')
                ->on('vehiculos')
                ->references('id');
            $table->foreign('proyecto_id')
                ->on('proyectos')
                ->references('id');
            $table->foreign('tipo_materiales')
                ->on('tipos_materiales')
                ->references('id');
            $table->foreign('carga_lugar_id')
                ->on('recorrido_proyectos')
                ->references('id');
            $table->foreign('desc_lugar_id')
                ->on('recorrido_proyectos')
                ->references('id');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operaciones_diaria');
    }
}
