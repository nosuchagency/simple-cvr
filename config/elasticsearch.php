<?php

return [
    'host' => env('ELASTICSEARCH_HOST', 'http://distribution.virk.dk'),
    'username' => env('ELASTICSEARCH_USERNAME'),
    'password' => env('ELASTICSEARCH_PASSWORD'),
    'url' => [
        'initial' => env('ELASTICSEARCH_INITIAL_URL', ''),
        'subsequent' => env('ELASTICSEARCH_SUBSEQUENT_URL', '')
    ],
    'size' => (int)env('ELASTICSEARCH_SIZE', 3000)
];