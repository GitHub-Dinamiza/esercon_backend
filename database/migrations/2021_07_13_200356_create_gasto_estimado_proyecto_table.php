<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastoEstimadoProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasto_estimado_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('gasto_estimado_operaciones_id');
            $table->double('valor',);
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('proyecto_id')
                  ->on('proyectos')
                  ->references('id');

            $table->foreign('gasto_estimado_operaciones_id')
                  ->on('gasto_estimado_operativo')
                  ->references('id');

            $table->foreign('user_id')
                  ->on('users')
                  ->references('id');

            $table->unique(['proyecto_id','gasto_estimado_operaciones_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gasto_estimado_proyecto');
    }
}
