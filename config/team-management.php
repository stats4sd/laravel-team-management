<?php

// config for Stats4sd/TeamManagement
return [
    'models' => [
        // what is the user model for the platform?
        'user' => env('TEAM_MANAGEMENT_USER_MODEL', 'App\Models\User'),
    ],


    'roles' => [
        //  what is the 'site administrator' role called?
        'admin' => env('SITE_ADMIN_ROLE', 'admin'),
    ],
];
