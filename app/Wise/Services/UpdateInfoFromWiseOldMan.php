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

        //TODO make sure it doesnt break when not found
        $this->console->withProgressBar(Account::query()->get(), function (Account $account) {
            rescue(function () use($account) {
                $account->raw_details = WiseOldManPlayer::details($account->username);

                $account->save();
            });
        });

        $this->console()->newLine(2);
    }
}
