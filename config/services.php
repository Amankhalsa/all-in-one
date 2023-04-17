<?php

return [

    /*
    |---------------------
    | Third Party Services
    |---------------------
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),],

       'google' => [
        'client_id' => '248410341745-lrp03rqt70neik6h1d5rrhi3sokqtdtn.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://testing.amankhalsa.in/projects/all-in-one/google/callback',
],
];