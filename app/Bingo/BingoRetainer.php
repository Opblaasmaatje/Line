<?php

namespace App\Bingo;

use App\Bingo\Models\Bingo;

class BingoRetainer
{
    use Makeable;

    public function __construct(
        protected Bingo $bingo,
    ){
        $this->teamhandler = new TeamHandler();

    }

    public function createTeam()
    {
        $this->teamhandler->createTeam();
    }
}
