<?php

namespace App\Modules\GooseBoards\Http\Resources;

use App\Modules\GooseBoards\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Team
 */
class TeamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'position' => $this->position,
            'accounts' => AccountResource::collection($this->accounts)
        ];
    }
}
