<?php

return [

    /*
    |--------------------------------------------------------------------------
    | New-submission notification
    |--------------------------------------------------------------------------
    |
    | When a customer submits the KYC form, a notification email is sent to this
    | address. Leave KYC_NOTIFY_EMAIL empty to disable notifications entirely.
    | Multiple recipients can be comma-separated.
    |
    */

    'notify_email' => env('KYC_NOTIFY_EMAIL'),

];
