<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposMaterialesProyectoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_materiales_proyecto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('tipo_material_id');
            $table->string('otros')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['proyecto_id','tipo_material_id']);
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->cascadeOnDelete();
            $table->foreign('tipo_material_id')->references('id')->on('tipos_materiales')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_materiales_proyecto');
    }
}
