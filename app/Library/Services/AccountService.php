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
        $details = $this->playerClientEndpoint->details($username);

        if (! $details) {
            return false;
        }

        return $details->saveToUser($user);
    }

    public function search(string $username): false|Collection
    {
        return $this->playerClientEndpoint->search($username);
    }

    public function records(Account $account, Metric|null $metric, Period|null $period = null): false|Collection
    {
        return $this->playerClientEndpoint->records($account->username, $metric, $period);
    }
}
