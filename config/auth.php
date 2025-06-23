<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users', // On laisse temporairement, mais on adaptera aussi si nécessaire
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Tu vas créer des guards personnalisés pour chaque rôle.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Optionnel : Si tu veux gérer via API
        'api' => [
            'driver' => 'token',
            'provider' => 'custom_users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | On utilise un provider custom qui va charger dynamiquement l'utilisateur
    | selon son type (étudiant, professeur, admin).
    |
    */

    'providers' => [
        'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Pour simplifier, on peut désactiver cette partie tant que tu n’en as pas besoin
    | ou créer des configurations spécifiques.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'custom_users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
