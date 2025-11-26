<?php

use App\Cron\AddSnapshotToUser;
use App\Cron\ApplyPointAllocation;
use App\Cron\UpdateBotActivity;
use App\Helpers\StringList;
use Discord\WebSockets\Intents;

return [
    'description' => env('DISCORD_BOT_DESCRIPTION', ''),

    'token' => env('DISCORD_TOKEN', ''),

    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT | Intents::GUILD_MEMBERS,

    'prefix' => env('DISCORD_COMMAND_PREFIX', '!'),

    'options' => [
        'loadAllMembers' => true,
    ],

    'http' => env('HTTP_SERVER', ':8080'),

    'timestamp' => 'h:i:s A',

    'admins' => StringList::format(env('BOT_ADMINS', '')),

    'admin-developer' => [
        'discord-id' => env('BOT_ADMIN_DEVELOPER_DISCORD_ID'),
        'wise-old-man-id' => env('BOT_ADMIN_DEVELOPER_WISE_OLD_MAN_ID'),
        'team-channel' => env('BOT_ADMIN_DEVELOPER_TEAM_CHANNEL'),
    ],

    'channel' => [
        'review' => env('BOT_REVIEW_CHANNEL'),
    ],

    'commands' => [
        //
    ],

    'menus' => [
        //
    ],

    'services' => [
        UpdateBotActivity::class,
        ApplyPointAllocation::class,
        AddSnapshotToUser::class,
    ],

    'events' => [
        //
    ],
];
