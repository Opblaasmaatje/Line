<?php

namespace App\Modules\GooseBoards\Models;

use App\Models\Account;
use App\Modules\GooseBoards\Models\Observers\TeamObserver;
use App\Modules\GooseBoards\Models\Pivot\AccountTeam;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property int $position
 * @property string $verification_code
 * @property string $channel_id
 * @property-read int $goose_board_id
 * @property-read string $current_position
 * @property-read GooseBoard $gooseBoard
 * @property-read Collection<Account> $accounts
 * @property-read Tile|null $objective
 */
#[ObservedBy(TeamObserver::class)]
class Team extends Model
{
    protected $fillable = [
        'name',
        'position',
        'verification_code',
        'channel_id',
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

    public function currentPosition(): Attribute
    {
        return Attribute::get(function () {
            return Str::of((string) $this->position)
                ->append('/')
                ->append((string) $this->gooseBoard->tiles->count());
        });
    }
}
