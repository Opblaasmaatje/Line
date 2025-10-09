<?php

namespace App\Modules\Pets\Models\Enums;

use App\Helpers\Enums\Concerns\AsHeadline;
use App\Helpers\Enums\Concerns\Searchable;

enum PetName: string
{
    use Searchable;
    use AsHeadline;
    case OLMLET = 'Olmlet';
}
