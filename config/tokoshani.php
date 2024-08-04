<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Service Providers
    |--------------------------------------------------------------------------
    |
    | Here you may specify the service providers for your application.
    | The service providers listed here will be automatically loaded
    | on the request to your application. Feel free to add your
    | own services to this array to grant expanded functionality.
    |
    */

    'providers' => [
        'vip-reseller' => [
            'config' => 'config/tokoshani-vipreseller.php',
            'serviceProvider' => 'Illuminate\\Support\\ServiceProvider\\TokoshaniVipresellerServiceProvider',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Gateways
    |--------------------------------------------------------------------------
    |
    | Here you may specify the payment gateways for your application.
    | The gateways listed here will be automatically loaded on the
    | request to your application. You can add multiple gateways
    | to support various payment methods in your application.
    |
    */

    'payment_gateway' => [
     //'tripay',
     //'xendit',
     //'midtrans'
    ],
];
