<?php

namespace App\Modules\GooseBoards\Models\Pivot;

use App\Models\Account;
use App\Modules\GooseBoards\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AccountTeam extends Pivot
{
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
