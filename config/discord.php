<?php

use App\Points\Services\ApplyPointAllocation;
use App\Wise\Services\UpdateInfoFromWiseOldMan;
use Discord\WebSockets\Intents;

return [
    'description' => env('DISCORD_BOT_DESCRIPTION', 'The Laracord Discord Bot.'),

    'token' => env('DISCORD_TOKEN', ''),

    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT | Intents::GUILD_MEMBERS,

    'prefix' => env('DISCORD_COMMAND_PREFIX', '!'),

    'options' => [
        'loadAllMembers' => true,
    ],

    'http' => env('HTTP_SERVER', ':8080'),

    'timestamp' => 'h:i:s A',

    'admins' => [
        '173783209069248512',
    ],

    'commands' => [
        Laracord\Commands\HelpCommand::class,
    ],

    'menus' => [
        //
    ],

    'services' => [
        ApplyPointAllocation::class,
        UpdateInfoFromWiseOldMan::class,
    ],

    'events' => [
        //
    ],
];
