<?php

namespace App\Points\Jobs\Action;

use App\Models\Account;
use App\Points\Configuration\BossPointAllocation;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;

class GivePointsAction
{
    public function __construct(
        protected BossPointAllocation $config
    ) {
    }

    public function run(
        Boss $boss,
        Account $account
    ): void {
        $thing = $this->config->forBoss($boss);

        $account->points()->updateOrCreate(
            [
                'account_id' => $account->getKey(),
                'source' => $boss->metric,
            ],
            [
                'amount' => $thing->calculate($boss->kills),
            ]
        );
    }
}
