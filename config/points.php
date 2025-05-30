<?php

use App\Helpers\OldSchoolRuneScape;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\CommanderZilyana;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Skill;

return [
    'bosses' => [
        CommanderZilyana::class => [
            //
        ],
        Boss::class => [
            'per' => 1,
            'give' => 1,
        ],
    ],
    'skills' => [
        Skill::class => [
            'per' => OldSchoolRuneScape::LVL99XP,
            'give' => 10,
        ]
    ],

    //
];
