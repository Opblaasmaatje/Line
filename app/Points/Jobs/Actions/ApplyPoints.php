<?php

namespace App\Points\Jobs\Actions;

use App\Models\Account;

class ApplyPoints
{
    public function run(
        Account $account,
        string $metric,
        int $amount,
    ){
        $account->points()->updateOrCreate(
            ['source' => $metric],
            ['amount' => $amount],
        );
    }
}
