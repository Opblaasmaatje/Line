<?php

namespace App\Points\Skills;

use App\Models\Account;
use App\Models\Snapshot;
use App\Points\Skills\Jobs\Action\GiveSkillPoints;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Skill;


/**
 * TODO rework with snapshot
 */
class ApplySkillPoints
{
    public function __construct(
        protected GiveSkillPoints $givePointsAction,
    ) {
    }

    public function apply(Snapshot $snapshot): void
    {
        $snapshot->details->latestSnapshot->data->collectSkills()->each(
            fn(Skill $skill) => $this->givePointsAction->run(
                account: $snapshot->account,
                skill: $skill,
            )
        );
    }
}
