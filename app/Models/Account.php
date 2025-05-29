<?php

namespace App\Models;

use App\Wise\Client\Players\Objects\Player;
use App\Wise\Client\Players\PlayerClient;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\App;


/**
 * @property int $id
 * @property string $username
 * @property string $user_id
 *
 * @property-read PlayerClient $player
 * @property-read Player $details
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

    protected function player(): Attribute
    {
        return Attribute::get(function (){
            /** @var PlayerClient $playerClient */
            $playerClient = App::make(PlayerClient::class);

            return $playerClient;
        });
    }

    public function details(): Attribute
    {
        return Attribute::get(
            fn() => $this->player->details($this->username)
        );
    }
}
