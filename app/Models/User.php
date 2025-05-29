<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $username
 * @property string $discord_id
 * @property bool $is_admin
 *
 * @property Account $account
 * @property Collection $accounts
 *
 * @property string $highlight
 */
class User extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'username',
        'discord_id',
        'is_admin',
    ];

    protected $casts = [
        'is_admin' => 'boolean'
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class);
    }

    public function highlight(): Attribute
    {
        return Attribute::get(function (){
           return "<@{$this->discord_id}>";
        });
    }
}
