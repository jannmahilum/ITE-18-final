<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application.
    |
    */

    'defaults' => [
        'guard' => 'web',  // You can change this to 'employee' or 'student' depending on the first login behavior
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | We define separate guards for each user type to avoid session conflicts.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',  // Default provider for users
        ],

        // Guard for Employee login
        'employee' => [
            'driver' => 'session',
            'provider' => 'employees',  // Use the employee provider
        ],

        // Guard for Student login
        'student' => [
            'driver' => 'session',
            'provider' => 'students',  // Use the student provider
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | These specify the database models for the different user types.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Employee provider
        'employees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Employee::class,
        ],

        // Student provider
        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Resets
    |--------------------------------------------------------------------------
    |
    | Separate password reset configurations for each user type.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // Password reset for Employees
        'employees' => [
            'provider' => 'employees',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        // Password reset for Students
        'students' => [
            'provider' => 'students',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Define the amount of seconds before a password confirmation screen times out.
    |
    */

    'password_timeout' => 10800,

];
