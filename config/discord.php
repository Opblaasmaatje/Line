<?php

use App\Bingo\Services\ReloadCommandsOptions;
use App\Bingo\SlashCommands\AddSubmissionObjective;
use App\Bingo\SlashCommands\CreateBingo;
use App\Bingo\SlashCommands\StartBingo;
use App\Points\Services\ApplyPointAllocation;
use App\Points\SlashCommands\GetPoints;
use App\Points\SlashCommands\GivePoints;
use App\Points\SlashCommands\Leaderboard;
use App\Wise\Services\AddSnapshotToUser;
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
        GetPoints::class,
        GivePoints::class,
        Leaderboard::class,
        CreateBingo::class,
        StartBingo::class,
        AddSubmissionObjective::class,
        Laracord\Commands\HelpCommand::class,
    ],

    'menus' => [
        //
    ],

    'services' => [
        ReloadCommandsOptions::class,
        ApplyPointAllocation::class,
        AddSnapshotToUser::class,
    ],

    'events' => [
        //
    ],
];
