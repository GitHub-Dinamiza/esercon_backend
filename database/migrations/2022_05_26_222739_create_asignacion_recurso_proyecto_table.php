<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionRecursoProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_recurso_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->boolean('state')->default(true);
            $table->timestamps();

            $table->foreign('proyecto_id')
                ->references('id')
                ->on('proyectos');
            $table->foreign('vehiculo_id')
                ->references('id')
                ->on('vehiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asignacion_recurso_proyecto');
    }
}
