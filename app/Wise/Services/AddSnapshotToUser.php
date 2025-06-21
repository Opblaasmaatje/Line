<?php

namespace App\Wise\Services;

use App\Models\Account;
use App\Wise\Client\Exceptions\WiseOldManException;
use App\Wise\Facade\WiseOldManPlayer;
use Laracord\Services\Service;

/**
 * TODO add error handling for user not found
 */
class AddSnapshotToUser extends Service
{
    protected int $interval = 5;

    public function handle(): void
    {
        $this->console()->warn('Updating information from Wise Old Man');

        Account::query()
            ->with('snapshot')
            ->get()
            ->each($this->guardAgainstFailures(...));

        $this->console()->newLine(2);
    }

    public function guardAgainstFailures(Account $account): void
    {
        try {
            $account->snapshot->setAttribute(
                key: 'raw_details',
                value: WiseOldManPlayer::details($account->username)->toArray()
            );

            $account->snapshot->push();
        } catch (WiseOldManException $exception) {

            $className = get_class($this);

            $this->console()->error($exception->getMessage() . " in [$className]");
        }
    }
}
