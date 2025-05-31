<?php

namespace App\Models;

use App\Wise\Client\Players\Objects\PlayerObject;
use Brick\JsonMapper\JsonMapper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;

/**
 * @property int $id
 * @property string $username
 * @property array $raw_details
 * @property string $user_id
 *
 * @property-read int $total_points
 * @property-read PlayerObject|null $details
 * @property-read Collection<Point> $points
 */
class Account extends Model
{
    protected $fillable = [
        'username',
        'user_id',
        'raw_details',
    ];

    protected $casts = [
        'raw_details' => 'array',
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
        return Attribute::get(
            fn() => $this->points->sum('amount')
        );
    }

    public function details(): Attribute
    {
        return Attribute::get(function (){
            /** @var JsonMapper $mapper */
            $mapper = App::make(JsonMapper::class);

            return $mapper->map(
                json_encode($this->raw_details),
                PlayerObject::class
            );
        });
    }
}
