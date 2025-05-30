<?php

namespace App\Models;

use App\Points\Source;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property float $amount
 * @property Source $source
 * @property int $account_id
 *
 * @property Account $account
 */
class Point extends Model
{
    protected $casts = [
        'amount' => 'float',
        'source' => Source::class,
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
