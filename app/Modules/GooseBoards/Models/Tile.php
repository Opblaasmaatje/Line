<?php

namespace App\Modules\GooseBoards\Models;

use App\Modules\GooseBoards\Models\Observers\TileObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @property int $id
 * @property string $name
 * @property string|null $image_url
 * @property int $position
 * @property int $goose_board_id
 * @property-read GooseBoard $gooseBoard
 */
#[ObservedBy(TileObserver::class)]
class Tile extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'name',
        'position',
        'image_url',
    ];

    public $sortable = [
        'order_column_name' => 'position',
        'sort_when_creating' => true,
    ];

    public function gooseBoard(): BelongsTo
    {
        return $this->belongsTo(GooseBoard::class);
    }

    /**
     * @return HasMany<Submission, $this>
     */
    public function submission(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
