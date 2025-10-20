<?php

namespace App\Modules\GooseBoards\Models\Enums;

enum Status: string
{
    case APPROVED = 'Approved';
    case REJECTED = 'Rejected';
    case IN_PROCESS = 'In Process';
}
