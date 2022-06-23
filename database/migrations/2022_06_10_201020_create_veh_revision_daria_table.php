<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehRevisionDariaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veh_revision_daria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veh_item_revision_id');
            $table->unsignedBigInteger('vehiculo_id');
            $table->string('valor');
            $table->unsignedBigInteger('proyecto_id');
            $table->unsignedBigInteger('responsable_id');
            $table->text('comentario')->nullable();
            $table->date('fecha_revision');
            $table->time('hora');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('veh_item_revision_id')
                ->references('id')->on('veh_item_revision');
            $table->foreign('vehiculo_id')
                ->references('id')->on('vehiculos');
            $table->foreign('user_id')
                ->references('id')->on('users');
            $table->foreign('responsable_id')
                ->references('id')->on('personas');

            $table->foreign('proyecto_id')
                ->references('id')->on('proyectos');

            $table->unique(['veh_item_revision_id','vehiculo_id','fecha_revision']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veh_revision_daria');
    }
}
