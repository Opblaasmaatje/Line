<?php

namespace App\Repository;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function findAccount(string $discordId): Account
    {
        return Account::query()
            ->whereHas('user', fn(Builder $query) => $query->where('discord_id', $discordId))
            ->firstOrFail();
    }
}
