<?php

namespace App\Modules\GooseBoards\Library\Repository;

use App\Modules\GooseBoards\Models\Queries\TileQuery;
use App\Modules\GooseBoards\Models\Tile;
use Illuminate\Database\Eloquent\Collection;

class TileRepository
{
    public readonly TileQuery $query;

    public function __construct()
    {
        $this->query = Tile::query();
    }

    public function find($name): ?Tile
    {
        return $this
            ->query
            ->whereLike('name', $name)
            ->first();
    }

    public function search(mixed $value): Collection
    {
        return $this->query->whereLike('name', $value)->get();
    }
}
