<?php

namespace App\Modules\GooseBoards\Models\Observers;

use App\Modules\GooseBoards\Models\Tile;

// todo remove
class TileObserver
{
    public function created(Tile $tile): void
    {
//         $tile->fill([
//             'position' => $tile->gooseBoard->tiles->count(),
//         ])
//             ->save();
    }
}
