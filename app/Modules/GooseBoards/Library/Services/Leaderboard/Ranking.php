<?php

namespace App\Modules\GooseBoards\Library\Services\Leaderboard;

use App\Modules\GooseBoards\Models\Team;

class Ranking
{
    public function __construct(
        public readonly Team $team,
        public readonly int $ranking,
    ) {
    }

    public function getIcon(): ?string
    {
        return match ($this->ranking) {
            1 => ':first_place:',
            2 => ':second_place:',
            3 => ':third_place:',
            default => ':small_blue_diamond:',
        };
    }

    public function getPosition(): string
    {
        return $this->team->current_position;
    }
}
