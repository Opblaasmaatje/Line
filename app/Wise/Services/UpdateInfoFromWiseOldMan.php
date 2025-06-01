<?php

namespace App\Wise\Services;

use App\Models\Account;
use App\Wise\Facade\WiseOldManPlayer;
use Laracord\Services\Service;

class UpdateInfoFromWiseOldMan extends Service
{
    protected int $interval = 5;

    public function handle(): void
    {
        $this->console()->warn('Updating information from Wise Old Man');

        $this->console->withProgressBar(
            totalSteps: Account::query()->get(),
            callback: function (Account $account) {
                $account->snapshot->setAttribute(
                    key: 'raw_details',
                    value: WiseOldManPlayer::details($account->username)->toArray()
                );

                $account->snapshot->push();
            }
        );

        $this->console()->newLine(2);
    }
}
