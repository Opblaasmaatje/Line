<?php

namespace App\Modules\GooseBoards\Library\Service;

use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Tile;

class TileService
{
    public function create(GooseBoard $board, array $data, int $index): Tile
    {
        return $board->tiles()->create($data + [
            'index' => $index,
        ]);
    }
}
