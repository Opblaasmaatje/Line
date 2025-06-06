<?php

return [
    'name' => env('APP_NAME', 'Laracord'),

    'version' => app('git.version'),

    'env' => env('APP_ENV', 'production'),

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    'providers' => [
        App\Providers\BotServiceProvider::class,
        App\Wise\Providers\OldManProvider::class,
        \App\Points\Providers\AllocationServiceProvider::class,
    ],
];
