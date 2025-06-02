<?php

namespace App\Points\Jobs;

use App\Models\Account;
use App\Points\CanGivePoints;
use App\Points\Configuration\PointAllocationConfiguration;
use App\Points\Jobs\Actions\ApplyPoints;
use App\Points\Skills\Jobs\Action\GiveSkillPoints;
use Illuminate\Support\Collection;

/**
 * TODO rework with snapshot
 */
class AssignPoints
{
    public function __construct(
        protected PointAllocationConfiguration $config,
        protected ApplyPoints $action,
    ) {
    }

    public function apply(Account $account, Collection $collection): void
    {
        $collection->each(
            fn(CanGivePoints $give) => $this->action->run(
                account: $account,
                metric: $give->metric,
                amount: $this
                    ->config
                    ->getCalculator($give)
                    ->calculate($give->getAmount()),
            )
        );
    }
}
