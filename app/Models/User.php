<?php

namespace App\Models;

use App\Library\Repository\UserRepository;
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
}
