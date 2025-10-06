<?php

namespace App\Wise\Client\Endpoints\Players\DTO;

use App\Wise\Client\Enums\Build;
use App\Wise\Client\Enums\Country;
use App\Wise\Client\Enums\Status;
use App\Wise\Client\Enums\Type;
use Illuminate\Support\Carbon;

readonly class Player
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
}
