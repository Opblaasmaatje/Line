<?php

use App\Cron\AddSnapshotToUser;
use App\Cron\ApplyPointAllocation;
use App\Points\SlashCommands\GetPoints;
use App\Points\SlashCommands\GivePoints;
use App\Points\SlashCommands\Leaderboard;
use App\SlashCommands\SetAccount;
use App\Wise\SlashCommands\DeleteCompetition;
use App\Wise\SlashCommands\StartCompetition;
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

    'admins' => [
        '173783209069248512',
    ],

    'commands' => [
        SetAccount::class,
        GetPoints::class,
        GivePoints::class,
        Leaderboard::class,
        StartCompetition::class,
        DeleteCompetition::class,
        Laracord\Commands\HelpCommand::class,
    ],

    'menus' => [
        //
    ],

    'services' => [
        ApplyPointAllocation::class,
        AddSnapshotToUser::class,
    ],

    'events' => [
        //
    ],
];
