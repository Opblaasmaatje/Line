<?php

use App\Cron\AddSnapshotToUser;
use App\Cron\ApplyPointAllocation;
use App\Cron\UpdateBotActivity;
use App\Modules\GooseBoards\SlashCommands\GooseBoardLeaderboard;
use App\Modules\GooseBoards\SlashCommands\GooseBoardObjective;
use App\Modules\Pets\SlashCommands\CheckPets;
use App\Modules\Pets\SlashCommands\ProofPet;
use App\Modules\Pets\SlashCommands\SubmitPet;
use App\Modules\Points\SlashCommands\PointsCheck;
use App\Modules\Points\SlashCommands\PointsGive;
use App\Modules\Points\SlashCommands\PointsLeaderboard;
use App\Wise\SlashCommands\Account\GetRecords;
use App\Wise\SlashCommands\Account\SetAccount;
use App\Wise\SlashCommands\Competition\CompetitionCreate;
use App\Wise\SlashCommands\Competition\CompetitionDelete;
use App\Wise\SlashCommands\Competition\CompetitionLeaderboard;
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

    'admin-developer' => [
        'discord-id' => env('BOT_ADMIN_DEVELOPER_DISCORD_ID'),
        'wise-old-man-id' => env('BOT_ADMIN_DEVELOPER_WISE_OLD_MAN_ID'),
    ],

    'commands' => [
        SetAccount::class,
        PointsCheck::class,
        PointsGive::class,
        PointsLeaderboard::class,
        CompetitionCreate::class,
        CompetitionDelete::class,
        CompetitionLeaderboard::class,
        GetRecords::class,
        SubmitPet::class,
        CheckPets::class,
        ProofPet::class,
        GooseBoardObjective::class,
        GooseBoardLeaderboard::class,
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
