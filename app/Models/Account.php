<?php

namespace App\Models;

use App\Modules\GooseBoards\Models\Team;
use App\Modules\Pets\Models\Pet;
use App\Modules\Points\Models\Point;
use App\Wise\Helpers\WiseOldManUrl;
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
 * @property string $external_id
 * @property-read User $user
 * @property-read Collection<Point> $points
 * @property-read Collection<Pet> $pets
 * @property-read Collection<Team> $teams
 * @property-read Snapshot $snapshot
 * @property-read int $total_points
 * @property-read string $url
 */
class Account extends Model
{
    protected $fillable = [
        'username',
        'user_id',
        'external_id',
        'discord_id',
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

    /**
     * @return HasMany<Pet, $this>
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class)->withTimestamps();
    }

    public function totalPoints(): Attribute
    {
        return Attribute::get(
            fn () => $this->points->sum('amount')
        );
    }

    public function url(): Attribute
    {
        return Attribute::get(
            fn () => WiseOldManUrl::forPlayer($this->username)
        );
    }
}
