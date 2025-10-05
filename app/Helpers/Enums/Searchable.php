<?php

namespace App\Helpers\Enums;

use Illuminate\Support\Collection;

trait Searchable
{
    abstract public function toHeadline(): string;

    public static function search(string $search): Collection
    {
        return Collection::make(self::cases())
            ->filter(fn (self $item) => str_contains(strtolower($item->value), $search))
            ->where('value', $search);
    }
}
