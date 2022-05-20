<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidacionArchivoEntidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validacion_archivo_entidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('general_data_id');
            $table->string('entidad');
            $table->boolean('valida_fecha');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('general_data_id')
                ->references('id')
                ->on('general_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validacion_archivo_entidad');
    }
}
