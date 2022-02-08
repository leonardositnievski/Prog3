<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('bio');
            $table->string('photo_url')->nullable();
            $table->string('username');
            $table->string('password');
            $table->json('settings')->default(json_encode([
                'private_profile' => false
            ]));
            $table->boolean('admin')->default(false);
            $table->timestamps();
            $table->string('api_token', 80)
                                    ->unique()
                                    ->nullable()
                                    ->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
