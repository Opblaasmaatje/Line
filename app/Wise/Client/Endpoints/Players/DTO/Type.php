<?php

namespace App\Wise\Client\Endpoints\Players\DTO;

enum Type: string
{
    case Unknown = 'unknown';
    case Regular = 'regular';
    case Ironman = 'ironman';
    case Hardcore = 'hardcore';
    case Ultimate = 'ultimate';
}
