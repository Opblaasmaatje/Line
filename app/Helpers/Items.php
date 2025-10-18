<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class Items
{
    protected Collection $itemList;

    public function __construct(array $itemsList)
    {
        $this->itemList = collect($itemsList);
    }

    /**
     * @return array{id: int, name: string}
     */
    public static function getOne(): array
    {
        return new self(self::itemList())->itemList->random();
    }

    protected static function itemList(): array
    {
        return json_decode(file_get_contents(
            database_path('osrs-items.json')
        ), true);
    }
}
