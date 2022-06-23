<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosRevisionDiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_revision_diaria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veh_revision_daria_id');
            $table->string('nombre')->unique();

            $table->string('ruta');
            $table->string('extension')->nullable();
            $table->float('tamanio')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('veh_revision_daria_id')
                ->references('id')->on('veh_revision_daria');
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_revision_dia');
    }
}
