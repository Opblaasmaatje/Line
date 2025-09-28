<?php

namespace App\Wise\Client\Endpoints\Players\DTO;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Snapshot;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

readonly class PlayerSnapshot implements Arrayable
{
    public function __construct(
        public int $id,
        public string $username,
        public string $displayName,
        public Type $type,
        public Build $build,
        public Status $status,
        public Country|null $country,
        public bool $patron,
        public float $exp,
        public float $ehp,
        public float $ttm,
        public float $tt200m,
        public string $registeredAt,
        public string|null $updatedAt,
        public string|null $lastChangedAt,
        public string|null $lastImportedAt,
        public int $combatLevel,
        public Archive|null $archive,
        public Snapshot|null $latestSnapshot,
    ) {
    }

    protected function getAsCarbon(string|null $timeStamp): Carbon|null
    {
        return Carbon::make($timeStamp);
    }

    public function getRegisteredAt(): Carbon|null
    {
        return $this->getAsCarbon($this->registeredAt);
    }

    public function getUpdatedAt(): Carbon|null
    {
        return $this->getAsCarbon($this->updatedAt);
    }

    public function getLastChangedAt(): Carbon|null
    {
        return $this->getAsCarbon($this->lastChangedAt);
    }

    public function getLastImportedAt(): Carbon|null
    {
        return $this->getAsCarbon($this->lastImportedAt);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
