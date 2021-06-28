<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposViasProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_vias_proyecto', function (Blueprint $table) {
            $table->id();
            //$table->string('nombre');
            $table->unsignedBigInteger('tipo_via_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->string('otros')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['tipo_via_id','proyecto_id']);
            $table->foreign('tipo_via_id')->references('id')->on('tipos_vias')->cascadeOnDelete();
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_vias_proyecto');
    }
}
