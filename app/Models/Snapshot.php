<?php

namespace App\Models;

use App\Wise\Client\Players\Objects\PlayerSnapshot;
use Brick\JsonMapper\JsonMapper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;

/**
 * @property int $id
 * @property array $raw_details
 * @property int $account_id
 *
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
            $mapper = App::make(JsonMapper::class);

            return $mapper->map($this->getRawOriginal('raw_details'), PlayerSnapshot::class);
        });
    }
}
