<?php

namespace App\Wise\Client\Players\Objects\Snapshot;

readonly class Snapshot
{
    public function __construct(
        public int $id,
        public int $playerId,
        public string $createdAt, //todo cast
        public string|null $importedAt,
        public Data $data,
    ){
    }
}
