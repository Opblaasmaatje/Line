<?php

namespace App\Wise\Client\Endpoints\Players\DTO;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Snapshot;
use App\Wise\Client\Enums\Build;
use App\Wise\Client\Enums\Country;
use App\Wise\Client\Enums\Status;
use App\Wise\Client\Enums\Type;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

readonly class PlayerSnapshot extends Player implements Arrayable
{
    public function __construct(
        int $id,
        string $username,
        string $displayName,
        Type $type,
        Build $build,
        Status $status,
        Country|null $country,
        bool $patron,
        float $exp,
        float $ehp,
        float $ttm,
        float $tt200m,
        string $registeredAt,
        string|null $updatedAt,
        string|null $lastChangedAt,
        string|null $lastImportedAt,
        public int $combatLevel,
        public Archive|null $archive,
        public Snapshot|null $latestSnapshot,
    ) {
        parent::__construct(
            id: $id,
            username: $username,
            displayName: $displayName,
            type: $type,
            build: $build,
            status: $status,
            country: $country,
            patron: $patron,
            exp: $exp,
            ehp: $ehp,
            ttm: $ttm,
            tt200m: $tt200m,
            registeredAt: $registeredAt,
            updatedAt: $updatedAt,
            lastChangedAt: $lastChangedAt,
            lastImportedAt: $lastImportedAt,
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
