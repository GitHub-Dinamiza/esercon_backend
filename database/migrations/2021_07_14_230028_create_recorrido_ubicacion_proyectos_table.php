<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecorridoUbicacionProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido_ubicacion_proyectos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('recorrido_inicio_id');
            $table->unsignedBigInteger('recorrido_final_id');
            $table->unsignedBigInteger('accion_id');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('proyecto_id')
                  ->on('proyectos')
                  ->references('id');

            $table->foreign('recorrido_inicio_id')
                  ->on('recorrido_proyectos')
                  ->references('id');

            $table->foreign('recorrido_final_id')
                  ->on('recorrido_proyectos')
                  ->references('id');

            $table->foreign('accion_id')
                  ->on('accion_recorrido')
                  ->references('id');
            $table->foreign('user_id')
                  ->on('users')
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
        Schema::dropIfExists('recorrido_ubicacion_proyectos');
    }
}
