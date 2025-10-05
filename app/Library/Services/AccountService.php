<?php

namespace App\Library\Services;

use App\Models\Account;
use App\Models\User;
use App\Wise\Client\Endpoints\Players\PlayerEndpoint;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Enums\Period;
use Illuminate\Support\Collection;

class AccountService
{
    public function __construct(
        protected PlayerEndpoint $playerClientEndpoint,
    ) {
    }

    public function assignAccount(User $user, string $username): Account|false
    {
        $success = $this->playerClientEndpoint->details($username);

        if (! $success) {
            return false;
        }

        /** @var Account $account */
        $account = $user->account()->updateOrCreate([], values: [
            'username' => $username,
        ]);

        return $account;
    }

    public function search(string $username): false|Collection
    {
        return $this->playerClientEndpoint->search($username);
    }

    public function records(
        Account $account,
        Metric|null $metric,
        Period|null $period = null
    ) {
        return $this->playerClientEndpoint->records($account->username, $metric, $period);
    }
}
