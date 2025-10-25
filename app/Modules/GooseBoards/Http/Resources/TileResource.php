<?php

namespace App\Modules\GooseBoards\Http\Resources;

use App\Modules\GooseBoards\Models\Tile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Tile
 */
class TileResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'index' => $this->index,
        ];
    }
}
