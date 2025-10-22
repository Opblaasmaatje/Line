<?php

use App\Cron\AddSnapshotToUser;
use App\Cron\ApplyPointAllocation;
use App\Cron\UpdateBotActivity;
use App\Helpers\StringList;
use App\Modules\GooseBoards\SlashCommands\GooseBoardCheck;
use App\Modules\GooseBoards\SlashCommands\GooseBoardLeaderboard;
use App\Modules\GooseBoards\SlashCommands\GooseBoardObjective;
use App\Modules\GooseBoards\SlashCommands\GooseBoardTileSubmit;
use App\Modules\Pets\SlashCommands\CheckPets;
use App\Modules\Pets\SlashCommands\ProofPet;
use App\Modules\Pets\SlashCommands\SubmitPet;
use App\Modules\Points\SlashCommands\Admin\PointsGive;
use App\Modules\Points\SlashCommands\PointsCheck;
use App\Modules\Points\SlashCommands\PointsLeaderboard;
use App\SlashCommands\Admin\CompetitionCreate;
use App\SlashCommands\Admin\CompetitionDelete;
use App\SlashCommands\Admin\SetAccount;
use App\SlashCommands\Admin\SetAdmin;
use App\SlashCommands\CompetitionLeaderboard;
use App\SlashCommands\GetRecords;
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
        SetAccount::class,
        SetAdmin::class,
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
        GooseBoardCheck::class,
        GooseBoardTileSubmit::class,
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
