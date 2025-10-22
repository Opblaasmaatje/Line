<?php

namespace App\Modules\GooseBoards\Models\Pivot;

use App\Models\Account;
use App\Modules\GooseBoards\Models\Team;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $account_id
 * @property int $team_id
 * @property-read Account $account
 * @property-read Team $team
 */
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
