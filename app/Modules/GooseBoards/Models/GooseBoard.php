<?php

namespace App\Modules\GooseBoards\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string $wise_old_man_id ?? might have the be nullable?
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property-read Collection<Tile> $tiles
 * @property-read Collection<Team> $teams
 */
class GooseBoard extends Model
{
    protected $fillable = [
        'name',
        'image',
        'wise_old_man_id',
        'starts_at',
        'ends_at',
    ];

    /**
     * @return HasMany<Tile, $this>
     */
    public function tiles(): HasMany
    {
        return $this->hasMany(Tile::class)->orderBy('index');
    }

    /**
     * @return HasMany<Team, $this>
     */
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }
}
