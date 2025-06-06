<?php

namespace App\Bingo\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $name
 * @property int $bingo_id
 *
 * @property-read Collection<Account> $accounts
 * @property-read Bingo $bingo
 * @property-read Collection<Objective> $objectives
 */
class Team extends Model
{
    protected $fillable = [
        'name',
    ];

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class)
            ->withTimestamps()
            ->using(AccountTeam::class);
    }

    public function bingo(): BelongsTo
    {
        return $this->belongsTo(Bingo::class);
    }

    public function objectives(): HasMany
    {
        return $this->hasMany(Objective::class);
    }
}
