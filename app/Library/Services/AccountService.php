<?php

namespace App\Library\Services;

use App\Models\Account;
use App\Models\User;
use App\Wise\Client\Endpoints\Players\PlayerEndpoint;

class AccountService
{
    public function __construct(
        protected PlayerEndpoint $playerClientEndpoint,
    ) {
    }

    public function assignAccount(User $user, string $username): Account|false
    {
        $success = $this->playerClientEndpoint->update($username);

        if (! $success) {
            return false;
        }

        return $user->account()->updateOrCreate([], values: [
            'username' => $username,
        ]);
    }
}
