<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'name' => 'usuario',
            'bio'=> 'im a user',
            'email'=> 'usuario@usuario.com',
            'username'=> 'usuario',
            'password'=> Hash::make('123'),
        ]);
        Usuario::create([
            'name' => 'usuario_admin',
            'bio'=> 'im a admin user',
            'email'=> 'usuarioadmin@usuario.com',
            'username'=> 'usuario_admin',
            'password'=> Hash::make('123'),
            'admin' => true
        ]);
    }
}
