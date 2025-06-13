<?php

namespace App\Bingo\Models;

use App\Bingo\Models\Queries\BingoQuery;
use Discord\CommandClient\Command;
use Discord\DiscordCommandClient;
use Discord\Parts\Interactions\Command\Choice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property bool $has_started
 * @property bool $has_ended
 *
 * @property-read Collection<Objective> $objectives
 * @property-read Collection<Team> $teams
 * @method static BingoQuery query()
 */
class Bingo extends Model
{
    protected $fillable = [
        'name',
        'has_started',
        'has_ended',
    ];

    protected $casts = [
        'has_started' => 'boolean',
        'has_ended' => 'boolean',
    ];

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

    public function newEloquentBuilder($query): BingoQuery
    {
        return new BingoQuery($query);
    }

    public function toChoice(DiscordCommandClient $discord): Choice
    {
        return new Choice($discord, [
            'name' => $this->name,
            'value' => $this->id,
        ]);
    }
}
