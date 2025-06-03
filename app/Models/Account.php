<?php

namespace App\Models;

use App\Bingo\Models\Team;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $username
 * @property string $user_id
 *
 * @property-read User $user
 * @property-read Collection<Point> $points
 * @property-read Collection<Team> $teams
 * @property-read Snapshot $snapshot
 * @property-read int $total_points
 */
class Account extends Model
{
    protected $fillable = [
        'username',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function points(): HasMany
    {
        return $this->hasMany(Point::class);
    }

    public function snapshot(): HasOne
    {
        return $this->hasOne(Snapshot::class)->withDefault();
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }

    public function totalPoints(): Attribute
    {
        return Attribute::get(
            fn() => $this->points->sum('amount')
        );
    }
}
