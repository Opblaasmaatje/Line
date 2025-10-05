<?php

namespace App\Library\Repository;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function findAccount(string $discordId): Account|null
    {
        return Account::query()
            ->whereHas('user', fn (Builder $query) => $query->where('discord_id', $discordId))
            ->first();
    }

    public function setUserByDiscordId(string $discordId): User
    {
        return User::query()
            ->with('account')
            ->updateOrCreate([
                'discord_id' => $discordId,
            ]);
    }
}
