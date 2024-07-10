<?php
/*
                   _                   _           _
                 | |                 (_)         | |
  _ __  _ __   __| |  _ __  _ __ ___  _  ___  ___| |_
 | '_ \| '_ \ / _` | | '_ \| '__/ _ \| |/ _ \/ __| __|
 | | | | | | | (_| | | |_) | | | (_) | |  __/ (__| |_
 |_| |_|_| |_|\__,_| | .__/|_|  \___/| |\___|\___|\__|
                     | |            _/ |
                     |_|           |__/



*/

return [
    /*
    |--------------------------------------------------------------------------
    | Link Member Pages API
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */
    'memberlink' =>  env('MEMBER_LINK', null),

    /*
    |--------------------------------------------------------------------------
    | ID CHAT TELEGRAM FOR SENDING NOTIFICATION DEFAULT
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */
    'telegram_id_chat_admin' => env('TELEGRAM_ID_CHAT_ADMIN', '-4259907184'),


    'link-online' =>  env('ONLINE_LINK', null),
    'midtrans_link' => env('MIDTRANS_LINK', null),
    'midtrans_server_key' => env('MIDTRANS_SERVER_KEY_ENCODE64', null),
];
