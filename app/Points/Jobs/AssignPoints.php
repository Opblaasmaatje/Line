<?php

namespace App\Points\Jobs;

use App\Models\Account;
use App\Points\Configuration\PointAllocationConfiguration;
use App\Points\Jobs\Actions\ApplyPoints;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\CanGivePoints;
use Illuminate\Support\Collection;

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
            fn (CanGivePoints $canGivePoints) => $this->action->run(
                account: $account,
                metric: $canGivePoints->getMetric(),
                amount: $this
                    ->config
                    ->getCalculator($canGivePoints)
                    ->calculate($canGivePoints->getAmount()),
            )
        );
    }
}
