<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $amount
 * @property string $source
 * @property int $account_id
 *
 * @property Account $account
 */
class Point extends Model
{
    protected $fillable = [
        'account_id',
        'amount',
        'source',
    ];

    protected $casts = [
        'amount' => 'int',
        'source' => 'string',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
