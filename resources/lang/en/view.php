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
    "name" => 'name',
    "password" => "password",
    "password_hint" => "HINT : your password should be atleast 10 characters long",
    "password_confirm" => "password confirm",
    "username" => "username",
    "email" => "email",

    "create-account" =>[
        'title' => 'create account',
        'button' => 'create'
    ],
    
    "login" => "login",
    "logout" => "logout",
    "menu" =>[
        'settings' => 'Settings'
    ],
    "settings" => [
        'title' => 'Settings',
    ],
    "create-post"=>[
        'title' => 'Create post',
        'actions' =>[
            'submit' => 'Publish',
            'cancel' => 'Cancel'
        ]
    ],
    "post" => [
        "title" => 'title',
        'genre' => 'genre',
        'description' => 'description',
        'report' => 'Report post',
        'report-comment' => 'Report comment',
        'actions' => [
            'rate' => 'Rate',
            'comment' => 'Comment'
        ]
    ],


    'home' =>[
        'create-post' => 'Create new post'
    ],
    'profile' =>[
        'posts' => 'Posts',
        'edit_button' => 'Edit',
        'user' => [
            'image_description' => ':user_name profile picture'
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
