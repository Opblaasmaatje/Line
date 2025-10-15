<?php

namespace App\Modules\Pets\Models;

use App\Models\Account;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use App\Modules\Pets\Models\Queries\PetQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $account_id
 * @property PetName $name
 * @property string $image_url
 * @property Status $status
 * @property Carbon $updated_at
 * @property Carbon $created_at
 *
 * @method static PetQuery query()
 */
class Pet extends Model
{
    protected $fillable = [
        'name',
        'status',
        'image_url',
    ];

    protected $casts = [
        'name' => PetName::class,
        'status' => Status::class,
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function newEloquentBuilder($query): PetQuery
    {
        return new PetQuery($query);
    }
}
