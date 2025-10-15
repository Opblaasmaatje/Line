<?php

namespace App\Wise\Client\Enums;

use App\Helpers\Enums\Contracts\CanHeadline;
use App\Helpers\Enums\Contracts\Concerns\AsHeadline;
use Illuminate\Support\Str;

enum Period: string implements CanHeadline
{
    use AsHeadline;

    case FIVE_MIN = 'five_min';

    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';

    case YEAR = 'year';

    public static function fromHeadline(string $headline): self
    {
        return self::from(
            Str::snake($headline)
        );
    }
}
