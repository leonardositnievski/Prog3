<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostagemAvaliacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postagem_avaliacoes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('postagem_id');
            $table->foreign('postagem_id')->references('id')->on('postagens');

            $table->unsignedBigInteger('avaliador_id');
            $table->foreign('avaliador_id')->references('id')->on('usuarios');
            $table->integer('nota');
            $table->text('avaliacao_texto')->nullable();
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
        Schema::dropIfExists('postagem_avaliacoes');
    }
}
