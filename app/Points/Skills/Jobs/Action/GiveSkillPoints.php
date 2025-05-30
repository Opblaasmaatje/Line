<?php

namespace App\Points\Skills\Jobs\Action;

use App\Models\Account;
use App\Points\Configuration\PointAllocationConfiguration;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Skill;

class GiveSkillPoints
{
    public function __construct(
        protected PointAllocationConfiguration $config
    ) {
    }

    public function run(Account $account, Skill $skill): void
    {
        $thing = $this->config->forSkill($skill);

        $account->points()->updateOrCreate(
            [
                'source' => $skill->metric,
            ],
            [
                'amount' => $thing->calculate($skill->experience),
            ]
        );
    }
}
