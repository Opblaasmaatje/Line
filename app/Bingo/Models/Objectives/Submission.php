<?php

namespace App\Bingo\Models\Objectives;

use App\Bingo\Models\Objective;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;


/**
 * @property int $id
 * @property string $name
 */
class Submission extends Model
{
    protected $fillable = [
        'name',
    ];

    public function objective(): MorphOne
    {
        return $this->morphOne(Objective::class, 'task');
    }
}
