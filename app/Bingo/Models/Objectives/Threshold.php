<?php

namespace App\Bingo\Models\Objectives;

use App\Bingo\Models\Objective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property int $id
 * @property int $amount
 */
class Threshold extends Model
{
    protected $casts = [
        'amount' => 'integer',
    ];

    public function objective(): MorphOne
    {
        return $this->morphOne(Objective::class, 'task');
    }
}
