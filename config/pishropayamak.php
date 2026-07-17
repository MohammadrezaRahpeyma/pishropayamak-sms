<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PishroPayamak Service Token
    |--------------------------------------------------------------------------
    |
    | Enter your token obtained from the PishroPayamak user panel.
    | This token is used for authentication with the web service.
    |
    */
    'token' => env('PISHROPAYAMAK_TOKEN', ''),

    /*
    |--------------------------------------------------------------------------
    | Default Sender Number
    |--------------------------------------------------------------------------
    |
    | Enter your dedicated sender line number here.
    | This number will be used as the default sender for all messages.
    |
    */
    'default_from' => env('PISHROPAYAMAK_FROM', ''),

    /*
    |--------------------------------------------------------------------------
    | Default Message Type
    |--------------------------------------------------------------------------
    |
    | 0 = Normal message
    | 1 = Flash message (pop-up display)
    |
    */
    'default_type' => env('PISHROPAYAMAK_TYPE', 0),
];