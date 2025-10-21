<?php

namespace App\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Motivation
{
    protected Collection $motivation;

    public function __construct(array $itemsList)
    {
        $this->motivation = collect($itemsList);
    }

    public static function get(string|null $placeholder): string
    {
        $item = new self(self::itemList())
            ->motivation
            ->shuffle()
            ->first();

        return Str::of($item['text'])->replace('#placeholder#', $placeholder);
    }

    protected static function itemList(): array
    {
        return json_decode(file_get_contents(
            database_path('motivation.json')
        ), true);
    }
}
