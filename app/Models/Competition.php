<?php

namespace App\Models;

use App\Wise\Client\Enums\Metric;
use App\Wise\Helpers\WiseOldManUrl;
use Discord\Discord;
use Discord\Parts\Interactions\Command\Choice;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

/**
 * @property int $id
 * @property string $wise_old_man_id
 * @property string $title
 * @property Metric $metric
 * @property Carbon $starts_at
 * @property Carbon $ends_at
 * @property string $verification_code
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read string $url
 */
class Competition extends Model
{
    protected $fillable = [
        'wise_old_man_id',
        'title',
        'metric',
        'starts_at',
        'ends_at',
        'verification_code',
    ];

    protected $casts = [
        'metric' => Metric::class,
        'starts_at' => 'immutable_datetime',
        'ends_at' => 'immutable_datetime',
    ];

    public function url(): Attribute
    {
        return Attribute::get(function () {
            return WiseOldManUrl::forCompetition($this->wise_old_man_id);
        });
    }
}
