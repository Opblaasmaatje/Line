<?php

namespace App\Bingo;

use App\Bingo\Models\Bingo;
use App\Bingo\Models\Objective;
use App\Bingo\Models\Team;

class BingoHandler
{
    use Makeable;

    public function __construct(
        protected Bingo $bingo,
    ){
    }

    public function findTeam(string $teamName): TeamHandler
    {
        /** @var Team $team */
        $team = $this->bingo
            ->teams()
            ->firstOrCreate(['name' => $teamName]);

        return new TeamHandler($team);
    }

    public function addObjective(Objective $objective): static
    {
        $this->bingo->teams->each(
            fn(Team $team) => (new TeamHandler($team))->addObjective($objective)
        );

        return $this;
    }
}
