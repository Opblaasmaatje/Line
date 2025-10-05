<?php

namespace App\Wise\Client\Enums;

enum Type: string
{
    case UNKNOWN = 'unknown';
    case REGULAR = 'regular';
    case IRONMAN = 'ironman';
    case HARDCORE = 'hardcore';
    case ULTIMATE = 'ultimate';
}
