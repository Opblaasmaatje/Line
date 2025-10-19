<?php

namespace App\Modules\GooseBoards\Http\Resources;

use App\Modules\GooseBoards\Models\GooseBoard;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin GooseBoard
 */
class GooseBoardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'wise_old_man_id' => $this->wise_old_man_id,
            'name' => $this->name,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
            'tiles' => TileResource::collection($this->tiles),
            'teams' => TeamResource::collection($this->teams),
        ];
    }
}
