<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiensiaLaboralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiensia_laboral', function (Blueprint $table) {
            $table->id();
            $table->string('empresa');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->string('nombre_contacto');
            $table->string('numero_contacto');
            $table->unsignedBigInteger('persona_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('persona_id')->references('id')->on('personas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiensia_laboral');
    }
}
