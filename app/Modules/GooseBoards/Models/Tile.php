<?php

namespace App\Modules\GooseBoards\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $goose_board_id
 * @property-read GooseBoard $gooseBoard
 */
class Tile extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function gooseBoard(): BelongsTo
    {
        return $this->belongsTo(GooseBoard::class);
    }
}
