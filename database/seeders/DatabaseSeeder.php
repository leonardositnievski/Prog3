<?php

namespace Database\Seeders;

use App\Models\DenunciaTipo;
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

        $nudity = DenunciaTipo::create(['nome' => 'nudity'])->id;
        DenunciaTipo::insert([
            ['nome' => 'adult_nudity','categoria_pai_id' => $nudity],
            ['nome' => 'sexually_suggestive','categoria_pai_id' => $nudity],
            ['nome' => 'sexual_exploitation','categoria_pai_id' => $nudity],
            ['nome' => 'pedophilia','categoria_pai_id' => $nudity],
        ]);

    
        $violence = DenunciaTipo::create(['nome' => 'violence'])->id; 
        DenunciaTipo::insert([
            ['nome' => 'explicit_violence','categoria_pai_id' => $violence],
            ['nome' => 'death','categoria_pai_id' => $violence],
            ['nome' => 'animal_violence','categoria_pai_id' => $violence],
            ['nome' => 'violent_threat','categoria_pai_id' => $violence],
        ]);

        $harassment = DenunciaTipo::create(['nome' => 'harassment'])->id; 

        $fake_news = DenunciaTipo::create(['nome' => 'fake_news'])->id;
        DenunciaTipo::insert([
            ['nome' => 'health','categoria_pai_id' => $fake_news],
            ['nome' => 'politics','categoria_pai_id' => $fake_news],
            ['nome' => 'social_issues','categoria_pai_id' => $fake_news],
            ['nome' => 'other','categoria_pai_id' => $fake_news],
        ]);

        $spam = DenunciaTipo::create(['nome' => 'spam'])->id;
        $hate_speech = DenunciaTipo::create(['nome' => 'hate_speech'])->id; 
        DenunciaTipo::insert([
            ['nome' => 'race_ethnicity','categoria_pai_id' => $hate_speech],
            ['nome' => 'nationality','categoria_pai_id' => $hate_speech],
            ['nome' => 'religion','categoria_pai_id' => $hate_speech],
            ['nome' => 'sexual_orientation','categoria_pai_id' => $hate_speech],
            ['nome' => 'disability_illness','categoria_pai_id' => $hate_speech],
            ['nome' => 'other','categoria_pai_id' => $hate_speech],
        ]);
        
        $other = DenunciaTipo::create(['nome' => 'other'])->id;

    }
}
