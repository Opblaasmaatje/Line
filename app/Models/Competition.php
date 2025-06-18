<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $metric
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property string $verification_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Competition extends Model
{
    protected $casts = [
        'starts_at' => 'immutable_datetime',
        'ends_at' => 'immutable_datetime',
    ];
}
