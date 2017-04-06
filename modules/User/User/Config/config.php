<?php

return [
    'name' => 'User',
    'facebook' => [
        'client_id' => env('F_CID'),
        'client_secret' => env('F_CS'),
        'redirect' => env('F_CBU'),
    ],
    'google' => [
        'client_id' => env('G_CID'),
        'client_secret' => env('G_CS'),
        'redirect' => env('G_CBU'),
    ],
];

