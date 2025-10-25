<?php

namespace App\Modules\GooseBoards\Library\Services;

use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Tile;

class TileService
{
    public function create(GooseBoard $board, array $data): Tile
    {
        return $board->tiles()->create($data);
    }

    public function insert(GooseBoard $board, string $objective, string $imageUrl ,int $index): Tile
    {
        return $board->tiles()->create([
            'name' => $objective,
            'image_url' => $imageUrl,
            'index' => $index, // we need to calculate the index and move other index's up!
        ]);
    }
}
