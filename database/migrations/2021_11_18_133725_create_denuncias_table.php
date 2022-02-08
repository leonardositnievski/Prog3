<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenunciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('denunciante_id');
            $table->foreign('denunciante_id')->references('id')->on('usuarios');

            $table->unsignedBigInteger('postagem_id')->nullable();
            $table->foreign('postagem_id')->references('id')->on('postagens');

            $table->unsignedBigInteger('tipo_denuncia_id');
            $table->foreign('tipo_denuncia_id')->references('id')->on('denuncias_tipos');

            $table->unsignedBigInteger('analizado_por_id')->nullable();
            $table->foreign('analizado_por_id')->references('id')->on('usuarios');

            $table->string('denuncia_texto')->nullable();
            $table->dateTime('analizado_em')->nullable();
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
        Schema::dropIfExists('denuncias');
    }
}
