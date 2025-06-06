<?php

namespace App\Bingo;

use App\Bingo\Models\Objective;
use App\Bingo\Models\Team;
use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;

class TeamHandler
{
    public function __construct(
        protected Team $team
    ) {
    }

    public function assign(Account $account): self
    {
        $this->team->accounts()->attach($account);

        return $this;
    }

    public function addObjective(Objective $objective): self
    {
        $this->team->objectives()->save($objective);

        return $this;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }
}
