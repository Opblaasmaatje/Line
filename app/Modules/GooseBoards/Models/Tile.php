<?php

namespace App\Modules\GooseBoards\Models;

use App\Modules\GooseBoards\Models\Observers\TileObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $image_url
 * @property int $index
 * @property int $goose_board_id
 * @property-read GooseBoard $gooseBoard
 */
#[ObservedBy(TileObserver::class)]
class Tile extends Model
{
    protected $fillable = [
        'name',
        'description',
        'index',
        'image_url',
    ];

    public function gooseBoard(): BelongsTo
    {
        return $this->belongsTo(GooseBoard::class);
    }
}
