<?php

namespace App\Helpers\Enums\Contracts\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait Searchable
{
    public static function search(string $search): Collection
    {
        return Collection::make(self::cases())
            ->filter(fn (self $item) => Str::startsWith($item->value, $search))
            ->values();
    }
}
