<?php

namespace App\Points;

use App\Models\Snapshot;
use App\Points\Bosses\Jobs\ApplyBossPoints;
use App\Points\Skills\ApplySkillPoints;

/**
 * todo rework to work with snapshot
 */
class PointAllocator
{
    public function __construct(
        protected ApplyBossPoints $boss,
        protected ApplySkillPoints $skill,
    ){
    }

    public function boss(Snapshot $snapshot): void
    {
        $this->boss->apply($snapshot);
    }

    public function skill(Snapshot $snapshot): void
    {
        $this->skill->apply($snapshot);
    }
}
