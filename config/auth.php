<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'Applicant',
    ],
    'guards' => [
        
        'web' => [
            'driver' => 'session',
            'provider' => 'Applicant',
        ],
        'api' => [
            'driver' => 'token',
            'provider' => 'Applicant',
        ],
        
        
        // For admin
        'admins' => [
            'driver' => 'session',
            'provider' => 'admins'
        ],
        'admins-api' => [
            'driver' => 'token',
            'provider' => 'admins',
        ]
    ],
    'providers' => [
        'Applicant' => [
            'driver' => 'eloquent',
            'model' => App\Applicant::class,
        ],
        // For admin
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Admin::class
        ]
    ],
    'passwords' => [
        'Applicant' => [
            'provider' => 'Applicant',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
        'admins' => [
            'provider' => 'admins',
            'email' => 'auth.emails.password',
            'table' => 'password_resets',
            'expire' => 60,
        ],
    ],
];
