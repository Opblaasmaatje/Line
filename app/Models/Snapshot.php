<?php

namespace App\Models;

use App\Wise\Client\Endpoints\Players\DTO\PlayerSnapshot;
use Brick\JsonMapper\JsonMapper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

/**
 * @property int $id
 * @property array $raw_details
 * @property int $account_id
 * @property-read Account $account
 * @property-read PlayerSnapshot $details
 */
class Snapshot extends Model
{
    protected $fillable = [
        'raw_details',
        'account_id',
    ];

    protected $casts = [
        'raw_details' => 'array',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function details(): Attribute
    {
        return Attribute::get(function () {
            return App::make(JsonMapper::class)->map(
                json: $this->getRawOriginal('raw_details'),
                className: PlayerSnapshot::class,
            );
        });
    }
}
