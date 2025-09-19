<?php

namespace App\Wise\Client\Endpoints\Players\DTO;

use Illuminate\Contracts\Support\Arrayable;

readonly class Archive implements Arrayable
{
    public function __construct(
        public string $playerId,
        public string $previousName,
        public string $archiveUsername,
        public string $restoredUsername,
        public string $createdAt,
        public string $restoredAt,
    ){
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
