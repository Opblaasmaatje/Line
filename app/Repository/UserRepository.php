<?php

namespace App\Repository;

use App\Bot;
use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function findAccount(string $discordId): Account|null
    {
        return Account::query()
            ->whereHas('user', fn(Builder $query) => $query->where('discord_id', $discordId))
            ->first();
    }
}
