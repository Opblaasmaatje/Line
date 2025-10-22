<?php

namespace App\Modules\GooseBoards\Library\Services;

use App\Modules\GooseBoards\Library\BoardGenerator\GooseBoardBoardGenerator;
use App\Modules\GooseBoards\Library\Repository\GooseBoardRepository;
use App\Modules\GooseBoards\Library\Services\Leaderboard\Leaderboard;
use App\Modules\GooseBoards\Models\GooseBoard;
use Carbon\CarbonPeriodImmutable;
use Illuminate\Support\Arr;

class GooseBoardService
{
    public function __construct(
        public readonly GooseBoardRepository $repository,
        protected TeamService $teamService,
        protected TileService $tileService,
    ) {
    }

    /**
     * @deprecated
     */
    public function createApi(array $data): GooseBoard
    {
        $board = GooseBoard::query()->create(
            Arr::only($data['goose_board'], (new GooseBoard)->getFillable())
        );

        collect($data['tiles'])->each(function (array $tile) use ($board) {
            return $this->tileService->create($board, $tile);
        });

        collect($data['teams'])->each(function (array $team) use ($board) {
            return $this->teamService->createApi($board, $team);
        });

        $board = $this->generateBoard($board);

        return $board->load(['teams', 'tiles']);
    }

    public function create(string $name, CarbonPeriodImmutable $period): GooseBoard
    {
        $board = new GooseBoard()->fill([
            'name' => $name,
            'starts_at' => $period->start,
            'ends_at' => $period->end,
            'image' => null,
        ]);

        $board->save();

        return $board;
    }

    public function leaderboard(GooseBoard $gooseBoard): Leaderboard
    {
        $gooseBoard->load('teams');

        return new Leaderboard($gooseBoard->teams);
    }

    public function generateBoard(GooseBoard $gooseBoard): GooseBoard
    {
      $generator = new GooseBoardBoardGenerator($gooseBoard);

      $gooseBoard->fill([
          'image' => $generator->filename,
      ])
          ->save();

      return $gooseBoard;
    }
}
