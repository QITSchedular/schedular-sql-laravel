<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*','api'],
    'allowed_methods' => ['POST', 'GET', 'OPTIONS', 'PUT', 'DELETE'],
    'allowed_origins' => ['https://schedular.qitsolution.co.in'],
    'allowed_origins_patterns' => ['^https?:\/\/schedular\.qitsolution\.co\.in\/?$'],
    'allowed_headers' => ['Content-Type', 'Accept', 'Authorization', 'X-Requested-With', 'Application', 'ip'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true,

];
