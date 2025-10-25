<?php

namespace App\Modules\GooseBoards\Library\Repository;

use App\Models\Account;
use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository
{
    public function findTeamByAccount(Account $account, GooseBoard $board): Team|null
    {
        return $board
            ->teams()
            ->whereHas('accounts', fn (Builder $query) => $query->whereKey($account->getKey()))
            ->first();
    }

    public function alreadyAssigned(Account $account, GooseBoard $board): bool
    {
        return $account
            ->teams()
            ->whereHas('gooseBoard', fn(Builder $query) => $query->whereKey($board->getKey()))
            ->exists();
    }

    public function searchByName(string $value): Collection
    {
        return Team::query()
            ->whereLike('name', $value)
            ->get();
    }

    public function get(): Collection
    {
        return Team::query()->get();
    }

    public function find(string $name): Team|null
    {
        return Team::query()
            ->whereLike('name', $name)
            ->first();
    }
}
