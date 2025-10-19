<?php

namespace App\Modules\GooseBoards\Library\Repository;

use App\Modules\GooseBoards\Models\GooseBoard;
use Illuminate\Database\Eloquent\Collection;

class GooseBoardRespository
{
    public function searchByName(mixed $value): Collection
    {
        return GooseBoard::query()
            ->whereLike('name', $value)
            ->get();
    }

    public function get(): Collection
    {
        return GooseBoard::query()->get();
    }

    public function find(string $name): GooseBoard|null
    {
        return GooseBoard::query()
            ->whereLike('name', $name)
            ->first();
    }
}
