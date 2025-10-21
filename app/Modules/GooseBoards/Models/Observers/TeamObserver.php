<?php

namespace App\Modules\GooseBoards\Models\Observers;

use App\Modules\GooseBoards\Models\Team;
use Illuminate\Support\Str;

class TeamObserver
{
    public function creating(Team $team): void
    {
        $team->fill([
            'code' => Str::random(6),
        ]);
    }
}
