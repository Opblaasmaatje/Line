<?php

use App\Cron\AddSnapshotToUser;
use App\Cron\ApplyPointAllocation;
use App\Cron\UpdateBotActivity;
use App\Modules\Pets\SlashCommands\CheckPets;
use App\Modules\Pets\SlashCommands\SubmitPet;
use App\Modules\Points\SlashCommands\GetPoints;
use App\Modules\Points\SlashCommands\GivePoints;
use App\Modules\Points\SlashCommands\Leaderboard;
use App\Wise\SlashCommands\Account\GetRecords;
use App\Wise\SlashCommands\Account\SetAccount;
use App\Wise\SlashCommands\Competition\DeleteCompetition;
use App\Wise\SlashCommands\Competition\LeaderboardCompetition;
use App\Wise\SlashCommands\Competition\StartCompetition;
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
        LeaderboardCompetition::class,
        GetRecords::class,
        SubmitPet::class,
        CheckPets::class,
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
