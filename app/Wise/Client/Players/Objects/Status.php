<?php

namespace App\Wise\Client\Players\Objects;

enum Status: string
{
    case Active = 'active';
    case Unranked = 'unranked';
    case Flagged = 'flagged';
    case Archived = 'archived';
    case Banned = 'banned';
}
