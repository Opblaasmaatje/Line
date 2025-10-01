<?php

namespace App\Cron;

use App\Library\Services\SnapshotService;
use App\Models\Account;
use Illuminate\Support\Facades\App;
use Laracord\Services\Service;

/**
 * TODO add error handling for user not found
 */
class AddSnapshotToUser extends Service
{
    protected int $interval = 100;

    public function handle(): void
    {
        $this->console()->warn('Updating information from Wise Old Man');

        $service = App::make(SnapshotService::class);

        Account::query()
            ->with('snapshot')
            ->get()
            ->each(function (Account $account) use ($service) {
                $success = $service->setSnapshot($account);

                if ($success) {
                    return;
                }

                $this->console()->error("Failed updating account for [{$account->username}]");
            });

        $this->console()->newLine(2);
    }
}
