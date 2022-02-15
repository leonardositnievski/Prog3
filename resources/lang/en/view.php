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
    "bio" => "bio",
    "photo" => "photo",
    "password" => "password",
    "password_hint" => "HINT : Your password should be at least 10 characters long",
    "password_confirm" => "passoword confirmation",
    "username" => "usename",
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
        'private_profile' => 'Private profile',
        'save' => "Save"
    ],


    "create-post"=>[
        'title' => 'Create Post',
        'actions' =>[
            'submit' => 'Publish',
            'cancel' => 'Cancel'
        ]
    ],
    "post" => [
        "title" => 'title',
        'genre' => 'genre',
        'description' => 'description',
        'report' => 'Report',
        'actions' => [
            'rate' => [
                'button' =>'Evaluate'
            ],
            'aprove' => 'Approve',
            'deny' => "Reject"
        ]
    ],


    'home' =>[
        'create-post' => 'Create post'
    ],
    'profile' =>[
        'posts' => 'Posts',
        'edit_button' => 'Edit',
        'user' => [
            'image_description' => ':user_name profile picture'
        ],
        'edit' =>[
            'button' => 'Save',
            'title' => 'Edit Profile'
        ]
    ],

    'report'=>[
        'sucess' => 'Report created successfully',
        'sucess_text' => 'We appreciate your feedback, we do our best to create a friendly environment and the user is the main part to make it happen!',
        'error' => 'Post already reported',
        'nudity' => "Nudity",
        'adult_nudity' => "Adult Nudity",
        'sexually_suggestive' => "Sexually Suggestive",
        'sexual_exploitation' => "Sexual Explotation",
        'pedophilia' => "Pedophilia",


        'violence' => "Violence",
        'explicit_violence' => "Explicit Violence",
        'death' => "Death",
        'animal_violence' => "Animal Violence",
        'violent_threat' => "Violent Thread",


        'harassment' => "Harassment",

        'fake_news' => "Fake news",
        'health' => "Health",
        'politics' => "Politics",
        'social_issues' => "Social Issues",

        'spam' => "Spam",

        'hate_speech' => "Hate Speech",
        'race_ethnicity' => "Race or Ethinicity",
        'nationality' => "Nationality",
        'religion' => "Religion",
        'sexual_orientation' => "Sexual Orientation",
        'disability_illness' => "Deisability or Illness",

        'other' => "Other",
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
