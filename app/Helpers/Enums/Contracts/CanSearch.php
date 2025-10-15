<?php

namespace App\Helpers\Enums\Contracts;

use Illuminate\Support\Collection;

interface CanSearch
{
    public static function search(string $search): Collection;
}
