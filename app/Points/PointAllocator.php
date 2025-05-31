<?php

namespace App\Points;

use App\Models\Account;
use App\Points\Bosses\Jobs\ApplyBossPoints;
use App\Points\Skills\ApplySkillPoints;
use App\Wise\Client\Players\Objects\PlayerObject;

class PointAllocator
{
    public function __construct(
        protected ApplyBossPoints $boss,
        protected ApplySkillPoints $skill,
    ){
    }

    public function boss(Account $account): void
    {
        $this->boss->apply($account);
    }

    public function skill(Account $account): void
    {
        $this->skill->apply($account);
    }
}
