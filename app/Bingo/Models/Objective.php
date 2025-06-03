<?php

namespace App\Bingo\Models;

use App\Bingo\Models\Objectives\Submission;
use App\Bingo\Models\Objectives\Threshold;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property int $team_id
 *
 * @property Team $team
 * @property Threshold|Submission $task
 */
class Objective extends Model
{
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function task(): MorphTo
    {
        return $this->morphTo('task');
    }
}
