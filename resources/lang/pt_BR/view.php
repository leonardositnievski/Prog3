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
