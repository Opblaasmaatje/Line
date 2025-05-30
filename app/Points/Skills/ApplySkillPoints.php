<?php

namespace App\Points\Skills;

use App\Models\Account;
use App\Points\Skills\Jobs\Action\GiveSkillPoints;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Skill;

class ApplySkillPoints
{
    public function __construct(
        protected GiveSkillPoints $givePointsAction,
    ) {
    }

    public function apply(Account $account): void
    {
        $account->details->latestSnapshot->data->collectSkills()->each(
            fn(Skill $skill) => $this->givePointsAction->run(
                account: $account,
                skill: $skill,
            )
        );
    }
}
