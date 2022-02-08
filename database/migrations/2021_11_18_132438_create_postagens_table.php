<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postagens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('usuarios');

            $table->text('descricao');
            $table->string('titulo');
            
            $table->unsignedBigInteger('autorizado_por_id')->nullable();
            $table->foreign('autorizado_por_id')->references('id')->on('usuarios');

            $table->string('photo_url')->nullable();
            $table->dateTime('autorizado_em')->nullable();
            $table->boolean('autorizado')->default(false);
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
        Schema::dropIfExists('postagens');
    }
}
