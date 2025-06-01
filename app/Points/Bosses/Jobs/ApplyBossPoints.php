<?php

namespace App\Points\Bosses\Jobs;

use App\Models\Snapshot;
use App\Points\Bosses\Jobs\Action\GiveBossPointsAction;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;

/**
 * @todo add tests
 *
 * TODO rework to work with snapshot instead
 */
class ApplyBossPoints
{
    public function __construct(
        protected GiveBossPointsAction $givePointsAction,
    ) {
    }

    public function apply(Snapshot $snapshot): void
    {
        $snapshot->details->latestSnapshot->data->collectBosses()->each(
            fn(Boss $boss) => $this->givePointsAction->run(
                account: $snapshot->account,
                boss: $boss,
            )
        );
    }
}
