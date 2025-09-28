<?php

namespace App\Points\Jobs\Actions;

use App\Models\Account;

class ApplyPoints
{
    public function run(
        Account $account,
        string $metric,
        int $amount,
    ): self {

        $account->points()->updateOrCreate(
            [
                'source' => $metric,
            ],
            [
                'amount' => $amount,
            ],
        );

        return $this;
    }
}
