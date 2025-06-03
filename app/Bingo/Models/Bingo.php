<?php

namespace App\Bingo\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property int $id
 * @property string $name
 *
 * @property-read Collection<Objective> $objectives
 * @property-read Collection<Team> $teams
 */
class Bingo extends Model
{
    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function objectives(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            related: Objective::class,
            through: Team::class,
        );
    }
}
