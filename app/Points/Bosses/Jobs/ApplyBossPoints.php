<?php

namespace App\Points\Bosses\Jobs;

use App\Models\Account;
use App\Points\Bosses\Jobs\Action\GiveBossPointsAction;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ApplyBossPoints
{
    public function __construct(
        protected GiveBossPointsAction $givePointsAction,
    ) {
    }

    public function apply(Account $account): void
    {
        $account->details->latestSnapshot->data->collectBosses()->each(
            fn(Boss $boss) => $this->givePointsAction->run(
                account: $account,
                boss: $boss,
            )
        );
    }
}
