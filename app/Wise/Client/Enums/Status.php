<?php

namespace App\Wise\Client\Enums;

enum Status: string
{
    case ACTIVE = 'active';
    case UNRANKED = 'unranked';
    case FLAGGED = 'flagged';
    case ARCHIVED = 'archived';
    case BANNED = 'banned';
}
