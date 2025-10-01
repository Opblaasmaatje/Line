<?php

namespace App\Cron;

use App\Models\Snapshot;
use App\Points\Facade\PointAllocation;
use Laracord\Services\Service;

class ApplyPointAllocation extends Service
{
    protected int $interval = 100;

    public function handle(): void
    {
        $this->console()->log('Starting point allocation');

        Snapshot::query()
            ->with(['account'])
            ->whereHas('account')
            ->get()
            ->each(function (Snapshot $snapshot) {
                $this->console()->log("Updating point allocation for [{$snapshot->account->username}]");

                PointAllocation::boss($snapshot);
                PointAllocation::skill($snapshot);
            });
    }
}
