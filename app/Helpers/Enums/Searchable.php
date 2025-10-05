<?php

namespace App\Helpers\Enums;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

trait Searchable
{
    abstract public function toHeadline(): string;

    public static function search(string $search): Collection
    {
        return Collection::make(self::cases())
            ->filter(fn (self $item) => Str::startsWith($item->value, $search))
            ->values();
    }
}
