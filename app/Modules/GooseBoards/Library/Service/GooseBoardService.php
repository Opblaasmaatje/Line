<?php

namespace App\Modules\GooseBoards\Library\Service;

use App\Modules\GooseBoards\Models\GooseBoard;
use Illuminate\Support\Arr;

class GooseBoardService
{
    public function __construct(
        protected TeamService $teamService,
        protected TileService $tileService,
    ){
    }

    public function create(array $data): GooseBoard
    {
        $board = GooseBoard::query()->create(
            Arr::only($data['goose_board'], (new GooseBoard)->getFillable())
        );

        collect($data['tiles'])->each(function (array $tile, int $index) use ($board) {
            return $this->tileService->create($board, $tile, $index);
        });

        collect($data['teams'])->each(function (array $team) use ($board) {
            return $this->teamService->create($board, $team);
        });

        return $board->load(['teams', 'tiles']);
    }
}
