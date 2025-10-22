<?php

namespace App\Library\Repository;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;

class UserRepository
{
    public readonly Builder $query;

    public function __construct()
    {
        $this->query = User::query();
    }

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

    /**
     * @return Collection<User>
     */
    public function admins(): Collection
    {
        return $this->query
            ->where('is_admin', true)
            ->orWhereIn('discord_id', Config::get('discord.admins'))
            ->get();
    }
}
