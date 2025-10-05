<?php

namespace App\Library\Services;

use App\Models\Account;
use App\Models\User;
use App\Wise\Client\Endpoints\Players\PlayerEndpoint;
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

        return $user->account()->updateOrCreate([], values: [
            'username' => $username,
        ]);
    }

    public function search(string $username): false|Collection
    {
        return $this->playerClientEndpoint->search($username);
    }
}
