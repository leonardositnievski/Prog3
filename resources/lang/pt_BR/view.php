<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    "name" => 'nome',
    "bio" => "bio",
    "photo" => "foto",
    "password" => "senha",
    "password_hint" => "DICA : sua senha deve conter pelo menos 10 caracteres",
    "password_confirm" => "confirmação da senha",
    "username" => "usuário",
    "email" => "email",

    "create-account" =>[
        'title' => 'criar conta',
        'button' => 'criar'
    ],
    
    "login" => "entrar",
    "logout" => "sair",
    "menu" =>[
        'settings' => 'Configurações'
    ],
    "settings" => [
        'title' => 'Configurações',
        'private_profile' => 'Perfil Privado',
        'save' => "Salvar"
    ],


    "create-post"=>[
        'title' => 'Criar publicação',
        'actions' =>[
            'submit' => 'Publicar',
            'cancel' => 'Cancelar'
        ]
    ],
    "post" => [
        "title" => 'título',
        'genre' => 'gênero',
        'description' => 'descrição',
        'report' => 'Denunciar',
        'report-comment' => 'Denunciar Comentario',
        'actions' => [
            'rate' => [
                'button' =>'Avaliar'
            ],
            'aprove' => 'Aprovar',
            'deny' => "Rejeitar"
        ]
    ],


    'home' =>[
        'create-post' => 'Criar nova publicação'
    ],
    'profile' =>[
        'posts' => 'Postagens',
        'edit_button' => 'Editar',
        'user' => [
            'image_description' => 'Foto de perfil de :user_name'
        ],
        'edit' =>[
            'button' => 'Salvar',
            'title' => 'Editar Perfil'
        ]
    ],

    'report'=>[
        'sucess' => 'Denuncia registrada com sucesso',
        'sucess_text' => 'Agradecemos o seu feedback, fazemos os possivel para criar um ambiente amigavel e o usuario é a principal peça para fazer com que isso aconteca!',
        'error' => 'Publicação ja denunciada',
        'nudity' => "Nudez",
        'adult_nudity' => "Nudez de Adultos",
        'sexually_suggestive' => "Sexualmente Sugestivo",
        'sexual_exploitation' => "Exploração Sexual",
        'pedophilia' => "Pedofilia",


        'violence' => "Violência",
        'explicit_violence' => "Violência Explícita",
        'death' => "Morte",
        'animal_violence' => "Violência Animal",
        'violent_threat' => "Ameaça violenta",


        'harassment' => "Assedio",

        'fake_news' => "Noticia Falsa",
        'health' => "Saùde",
        'politics' => "Politica",
        'social_issues' => "Questão Social",

        'spam' => "Spam",

        'hate_speech' => "Discurso de odio",
        'race_ethnicity' => "Raça ou etinia",
        'nationality' => "Nacionalidade",
        'religion' => "Religião",
        'sexual_orientation' => "Orientação Sexual",
        'disability_illness' => "Incapacidade ou doença",

        'other' => "Outro",
    ],
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
