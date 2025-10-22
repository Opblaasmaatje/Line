<?php

namespace App\Modules\GooseBoards\Library\Repository;

use App\Models\Account;
use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Team;
use Illuminate\Database\Eloquent\Builder;

class TeamRepository
{
    public function findTeam(Account $account, GooseBoard $board): Team|null
    {
        return $board->teams()
            ->whereHas('accounts', fn (Builder $query) => $query->whereKey($account->getKey()))
            ->first();
    }
}
