<?php

namespace App\Modules\GooseBoards\Models;

use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property int $position
 * @property-read int $goose_board_id
 * @property-read GooseBoard $gooseBoard
 * @property-read Collection<Account> $accounts
 */
class Team extends Model
{
    protected $fillable = [
        'name',
    ];

    public function gooseBoard(): BelongsTo
    {
        return $this->belongsTo(GooseBoard::class);
    }

    public function accounts(): BelongsToMany
    {
        return $this->belongsToMany(Account::class);
    }
}
