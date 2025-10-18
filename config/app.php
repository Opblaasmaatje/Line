<?php

use Livewire\LivewireServiceProvider;

return [
    'name' => env('APP_NAME', 'Laracord'),

    'version' => app('git.version'),

    'env' => env('APP_ENV', 'production'),

    'timezone' => env('APP_TIMEZONE', 'UTC'),

    'providers' => [
        App\Providers\BotServiceProvider::class,
        App\Wise\Providers\OldManProvider::class,
        App\Modules\Points\Providers\AllocationServiceProvider::class,
        LivewireServiceProvider::class
    ],

    'pet' => [
        'discord-channel' => env('PET_REVIEW_CHANNEL'),
    ],
];
