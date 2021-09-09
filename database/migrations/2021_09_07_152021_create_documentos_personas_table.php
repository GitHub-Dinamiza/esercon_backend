<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('tipo_archivo_id');
            $table->string('ruta');
            $table->string('extension')->nullable();
            $table->float('tamanio')->nullable();
            $table->date('fecha_espedicon')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->on('users')->references('id');
            $table->foreign('persona_id')->on('personas')->references('id');
            $table->foreign('tipo_archivo_id')->on('general_data')->references('id');
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
        Schema::dropIfExists('documentos_personas');
    }
}
