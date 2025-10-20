<?php

namespace App\Modules\GooseBoards\Models\Enums;

enum Status: string
{
    case IN_PROCESS = 'In process';

    case APPROVED = 'Approved';

    case REJECTED = 'Rejected';
}
