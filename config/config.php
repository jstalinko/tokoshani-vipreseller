<?php

return [

    /*
    |--------------------------------------------------------------------------
    | VIP-RESELLER API ID
    |--------------------------------------------------------------------------
    |
    | This value is the API ID provided by the VIP-Reseller service. This
    | ID is used to authenticate requests to the VIP-Reseller API. You should
    | set this in your environment file.
    |
    */

    'api_id' => env('TOKOSHANI_VIPRESELLER_API_ID'),

    /*
    |--------------------------------------------------------------------------
    | VIP-RESELLER API KEY
    |--------------------------------------------------------------------------
    |
    | This value is the API Key provided by the VIP-Reseller service. This key
    | is used in conjunction with the API ID to authenticate requests to the
    | VIP-Reseller API. You should set this in your environment file.
    |
    */

    'api_key' => env('TOKOSHANI_VIPRESELLER_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | VIP-RESELLER SIGN
    |--------------------------------------------------------------------------
    |
    | This value is the SIGN provided by the VIP-Reseller service. This
    | sign is used to further secure the requests to the VIP-Reseller API.
    | You should set this in your environment file.
    |
    */

    'sign' => env('TOKOSHANI_VIPRESELLER_SIGN'),

];
