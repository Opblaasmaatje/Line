<?php

namespace App\Modules\GooseBoards\Library\Services;

use App\Modules\GooseBoards\Library\Repository\TileRepository;
use App\Modules\GooseBoards\Models\GooseBoard;
use App\Modules\GooseBoards\Models\Tile;

class TileService
{
    public function __construct(
        public readonly TileRepository $repository,
    ) {
    }

    public function create(GooseBoard $board, array $data): Tile
    {
        return $board->tiles()->create($data);
    }

    public function insert(GooseBoard $board, string $objective, string $imageUrl, int $position): Tile
    {
        $tile = $board->tiles()->create([
            'name' => $objective,
            'image_url' => $imageUrl,
        ]);

        return $this->reorderTiles($tile, $position);
    }

    protected function reorderTiles(Tile $tile, int $position): Tile
    {
        $tile
            ->gooseBoard
            ->tiles()
            ->where('position', '>=', $position)
            ->increment('position');

        $tile->fill(['position' => $position])->save();

        Tile::setNewOrder(
            $tile
                ->gooseBoard
                ->tiles()
                ->orderBy('position')
                ->pluck('id')
                ->toArray()
        );

        return $tile;
    }

    public function remove(Tile $tile): void
    {
        $gooseBoard = $tile->load('gooseBoard')->gooseBoard;

        $tile->delete();

        $gooseBoard->load('tiles');

        Tile::setNewOrder($gooseBoard->tiles()->pluck('id')->toArray());
    }
}
