<?php

namespace App\Points\Jobs;

use App\Models\Account;
use App\Points\Jobs\Action\GivePointsAction;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use Illuminate\Bus\Queueable;

class ApplyBossPoints
{
    use Queueable;

    public function __construct(
        protected Account $account,
        protected GivePointsAction $givePointsAction
    ) {
    }

    public function handle()
    {
        $this->account->details->latestSnapshot->data
            ->collectBosses()
            ->each(function (Boss $boss) {
                $this->givePointsAction->run(
                    $boss,
                    $this->account,
                );
            });
    }
}
