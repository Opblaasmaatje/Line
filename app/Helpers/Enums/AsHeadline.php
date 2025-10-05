<?php

namespace App\Helpers\Enums;

use Illuminate\Support\Str;

trait AsHeadline
{
    public function toHeadline(): string
    {
        return Str::headline($this->value);
    }
}
