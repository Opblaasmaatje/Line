<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $amount
 * @property string $source
 * @property int $account_id
 *
 * @property-read string $title
 * @property-read Account $account
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

    public function title(): Attribute
    {
        return Attribute::get(
            fn() => Str::of($this->source)->replace('_', ' ')->title()
        );
    }
}
