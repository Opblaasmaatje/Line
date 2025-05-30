<?php

namespace App\Models;

use App\Wise\Client\Players\Objects\PlayerObject;
use App\Wise\Facade\Player;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $username
 * @property string $user_id
 *
 * @property-read int $total_points
 * @property-read PlayerObject $details
 * @property-read Collection<Point> $points
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

    public function totalPoints(): Attribute
    {
        return Attribute::get(function (){
            return $this->points->sum('amount');
        });
    }

    public function details(): Attribute
    {
        return Attribute::get(
            fn() => Player::details($this->username)
        );
    }
}
