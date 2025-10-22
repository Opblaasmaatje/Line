<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class StringList
{
    public static function format(string|null $string): array
    {
        if (is_null($string)) {
            $string = '';
        }

        return Collection::make(explode("\n", $string))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->toArray();
    }
}
