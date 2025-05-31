<?php

namespace App\Wise\Client\Players\Objects;

use Illuminate\Contracts\Support\Arrayable;

readonly class Archive implements Arrayable
{
    public function __construct(
        public string $playerId,
        public string $previousName,
        public string $archiveUsername,
        public string $restoredUsername,
        public string $createdAt, //TODO cast
        public string $restoredAt, //TODO cast
    ){
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
