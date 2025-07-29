<?php

return [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
    'scopes' => [
        \Google_Service_Sheets::SPREADSHEETS,
    ],
    'access_type' => 'offline',
    'approval_prompt' => 'force',
];
