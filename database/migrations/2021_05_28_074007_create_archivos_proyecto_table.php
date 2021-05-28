<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchivosProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos_proyecto', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('extension');
            $table->string('ruta');
            $table->float('tamanio')->nullable();
            $table->unsignedBigInteger('proceso_id');
            $table->text('detalle')->nullable();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('proceso_id')
                ->references('id')
                ->on('fn_procesos');
            $table->foreign('proyecto_id')
                ->references('id')
                ->on('proyectos');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos_proyecto');
    }
}
