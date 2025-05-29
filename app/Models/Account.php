<?php

namespace App\Models;

use App\Wise\Client\Players\Objects\PlayerObject;
use App\Wise\Facade\Player;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $username
 * @property string $user_id
 * @property int $tokens
 *
 * @property-read PlayerObject $details
 */
class Account extends Model
{
    protected $fillable = [
        'username',
        'user_id',
        'tokens',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): Attribute
    {
        return Attribute::get(
            fn() => Player::details($this->username)
        );
    }
}
