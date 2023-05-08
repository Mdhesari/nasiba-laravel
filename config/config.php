<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'base_url'  => env('NASIBA_BASE_URL', 'https://api.nasiba.ir/nig'),
    'terminal'  => env('NASIBA_TERMINAL_CODE'),
    'merchant'  => env('NASIBA_MERCHANT_CODE'),
    'callback'  => env('NASIBA_CALLBACK_URL'),
    'signature' => env('NASIBA_SIGNATURE'),
];