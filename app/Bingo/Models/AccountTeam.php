<?php

namespace App\Bingo\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $account_id
 * @property int $team_id
 *
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
