<?php

namespace App\Wise\Client\Enums;

use App\Helpers\Enums\Concerns\AsHeadline;

enum Period: string
{
    use AsHeadline;

    case FIVE_MIN = 'five_min';

    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';

    case YEAR = 'year';
}
