<?php

namespace App\Modules\GooseBoards\Library\Service\Leaderboard;

use App\Modules\GooseBoards\Models\Team;
use Illuminate\Database\Eloquent\Collection as DBCollection;
use Illuminate\Support\Collection;

class Leaderboard
{
    /**
     * @var Collection<int, Ranking>
     */
    public readonly Collection $teams;

    /**
     * @param DBCollection<int, Team> $teams
     */
    public function __construct(DBCollection $teams)
    {
        $this->teams = $teams
            ->sortByDesc('position')
            ->values()
            ->map(function (Team $team, int $index) {
                $team->load('gooseBoard');

                return new Ranking(
                    $team,
                    $index + 1,
                );
            });
    }
}
