<?php

namespace App\Helpers\Enums\Concerns;

use Illuminate\Support\Str;

trait AsHeadline
{
    public function toHeadline(): string
    {
        return Str::headline($this->value);
    }

    public static function fromHeadline(string $headline): self
    {
        return self::from(
            Str::snake($headline)
        );
    }
}
