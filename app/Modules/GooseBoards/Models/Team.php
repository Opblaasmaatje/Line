<?php

namespace App\Modules\GooseBoards\Models;

use App\Models\Account;
use App\Modules\GooseBoards\Models\Pivot\AccountTeam;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property int $position
 * @property-read int $goose_board_id
 * @property-read GooseBoard $gooseBoard
 * @property-read Collection<Account> $accounts
 * @property-read Tile|null $objective
 */
class Team extends Model
{
    protected $fillable = [
        'name',
        'position',
        'code',
    ];

    public function gooseBoard(): BelongsTo
    {
        return $this->belongsTo(GooseBoard::class);
    }

    public function accounts(): BelongsToMany
    {
        return $this
            ->belongsToMany(Account::class)
            ->using(AccountTeam::class)
            ->withTimestamps();
    }

    /**
     * @return HasMany<Submission, $this>
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function objective(): Attribute
    {
        return Attribute::get(function () {
            return $this->gooseBoard->tiles->firstWhere('index', $this->position);
        });
    }
}
