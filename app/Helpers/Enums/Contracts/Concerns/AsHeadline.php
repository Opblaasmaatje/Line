<?php

namespace App\Helpers\Enums\Contracts\Concerns;

use Illuminate\Support\Str;

trait AsHeadline
{
    public function toHeadline(): string
    {
        return Str::headline($this->value);
    }
}
