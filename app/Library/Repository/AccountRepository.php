<?php

namespace App\Library\Repository;

use App\Models\Account;

class AccountRepository
{
    public function findByUsername(string $username): Account
    {
        return Account::query()
            ->where('username', $username)
            ->firstOrFail();
    }
}
