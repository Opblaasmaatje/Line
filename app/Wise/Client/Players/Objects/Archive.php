<?php

namespace App\Wise\Client\Players\Objects;

readonly class Archive
{
    public function __construct(
        public string $playerId,
        public string $previousName,
        public string $archiveUsername,
        public string $restoredUsername,
        protected string $createdAt, //TODO cast
        protected string $restoredAt, //TODO cast
    ){
    }
}
