<?php

namespace App\Modules\GooseBoards\Models;

use App\Models\Account;
use App\Modules\GooseBoards\Models\Enums\Status;
use App\Modules\GooseBoards\Models\Queries\SubmissionQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property Status $status
 * @property string $verification_code
 * @property string $image_url
 * @property int $team_id
 * @property int $account_id
 * @property-read Tile $tile
 * @property-read Team $team
 * @property-read Account $account
 *
 * @method static SubmissionQuery query()
 */
class Submission extends Model
{
    protected $fillable = [
        'status',
        'image_url',
        'verification_code',
    ];

    protected $casts = [
        'status' => Status::class,
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function tile(): BelongsTo
    {
        return $this->belongsTo(Tile::class);
    }

    public function newEloquentBuilder($query): SubmissionQuery
    {
        return new SubmissionQuery($query);
    }
}
