<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '1686373518342456',
        'client_secret' => '60233f8c8d1d864c31c8a9399caa9c4b',
        'redirect' => 'http://localhost:8000/callback/facebook',
    ],
    'twitter' => [
        'client_id' => 'eiVBYhzh8yKsMVc6UhIJBiCk7',
        'client_secret' => '495EJBPGjftM30zyfsOSoitupBBF7kzmK2XfWBDVMstgCrBooS',
        'redirect' => 'http://localhost:8000/callback/twitter',
    ],
    'google' => [
    'client_id' => '919035463107-5hu0bdua1ttd4ssck30t5ad9ato5oifp.apps.googleusercontent.com', // configure with your app id
    'client_secret' => 'PfDwYSjhSuZn5ZjL3SgfP_vt', // your app secret
    'redirect' => 'http://localhost:8000/callback/google', // leave blank for now
    ],

];
