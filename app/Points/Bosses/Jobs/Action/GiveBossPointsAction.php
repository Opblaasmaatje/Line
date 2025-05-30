<?php

namespace App\Points\Bosses\Jobs\Action;

use App\Models\Account;
use App\Points\Configuration\PointAllocationConfiguration;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;

class GiveBossPointsAction
{
    public function __construct(
        protected PointAllocationConfiguration $config
    ) {
    }

    public function run(Account $account, Boss $boss): void
    {
        $thing = $this->config->forBoss($boss);

        $account->points()->updateOrCreate(
            [
                'source' => $boss->metric,
            ],
            [
                'amount' => $thing->calculate($boss->kills),
            ]
        );
    }
}
