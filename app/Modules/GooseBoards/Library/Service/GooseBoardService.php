<?php

namespace App\Modules\GooseBoards\Library\Service;

use App\Modules\GooseBoards\Models\GooseBoard;
use Illuminate\Support\Arr;

class GooseBoardService
{
    public function __construct(
        protected TeamService $teamService,
    ){
    }

    public function create(array $data): GooseBoard
    {
        $gooseBoard = GooseBoard::query()->create(
            Arr::only($data['goose_board'], (new GooseBoard)->getFillable())
        );

        foreach ($data['teams'] as $team) {
            $this->teamService->createTeam($gooseBoard, $team);
        }

        return $gooseBoard;
    }
}
