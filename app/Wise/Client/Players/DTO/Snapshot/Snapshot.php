<?php

namespace App\Wise\Client\Players\DTO\Snapshot;

use Illuminate\Contracts\Support\Arrayable;

readonly class Snapshot implements Arrayable
{
    public function __construct(
        public int $id,
        public int $playerId,
        public string $createdAt,
        public string|null $importedAt,
        public Data $data,
    ){
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
