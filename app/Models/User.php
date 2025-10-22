<?php

namespace App\Models;

use App\Library\Repository\UserRepository;
use App\Models\Queries\UserQuery;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $discord_id
 * @property bool $is_admin
 * @property Account $account
 * @property Collection $accounts
 * @property string $highlight
 *
 * @method static UserQuery query()
 */
class User extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'discord_id',
        'is_admin',
    ];

    protected $casts = [
        'is_admin' => 'boolean',
    ];

    public static function repository(): UserRepository
    {
        return new UserRepository;
    }

    /**
     * @return HasOne<Account, $this>
     */
    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function highlight(): Attribute
    {
        return Attribute::get(function () {
           return "<@{$this->discord_id}>";
        });
    }

    public function newEloquentBuilder($query): UserQuery
    {
        return new UserQuery($query);
    }
}
