<?php

namespace App\Helpers\Enums\Contracts;

use Illuminate\Support\Str;

interface CanHeadline
{
    public function toHeadline(): string;

    public static function fromHeadline(string $headline): self;
}
