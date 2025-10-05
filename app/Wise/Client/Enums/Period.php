<?php

namespace App\Wise\Client\Enums;

enum Period: string
{
    case FIVE_MIN = 'five_min';

    case DAY = 'day';

    case WEEK = 'week';

    case MONTH = 'month';

    case YEAR = 'year';
}
