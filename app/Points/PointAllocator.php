<?php

namespace App\Points;

use App\Models\Snapshot;
use App\Points\Jobs\AssignPoints;

/**
 * todo create test
 */
class PointAllocator
{
    public function __construct(
        protected AssignPoints $job,
    ) {
    }

    public function boss(Snapshot $snapshot): void
    {
        $this->job->apply(
            $snapshot->account,
            $snapshot->details->latestSnapshot->data->collectBosses(),
        );
    }

    public function skill(Snapshot $snapshot): void
    {
        $this->job->apply(
            $snapshot->account,
            $snapshot->details->latestSnapshot->data->collectSkills()
        );
    }
}
