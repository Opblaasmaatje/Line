<?php

namespace App\Bingo;

use App\Bingo\Models\Bingo;
use App\Bingo\Models\Objective;
use App\Bingo\Models\Team;

class BingoHandler
{
    use Makeable;

    public function __construct(
        protected Bingo|string $bingo,
    ){
        if(! $this->bingo instanceof Bingo){
            $this->bingo = $this->setBingo($bingo);
        }
    }

    public function team(string $teamName): TeamHandler
    {
        /** @var Team $team */
        $team = $this->bingo
            ->teams()
            ->firstOrCreate([
                'name' => $teamName,
            ]);

        return new TeamHandler($team);
    }

    public function addObjective(Objective $objective): static
    {
        $this->bingo->teams->each(
            fn(Team $team) => (new TeamHandler($team))->addObjective($objective)
        );

        return $this;
    }

    protected function setBingo(string $bingoName): Bingo
    {
        return Bingo::query()->firstOrCreate([
            'name' => $bingoName,
        ]);
    }

    public function start(): self
    {
        $this->bingo->has_started = true;

        $this->bingo->has_ended = false;

        $this->bingo->save();

        return $this;
    }
}
