<?php

namespace App\Wise\Client\Endpoints\Players\DTO;

use App\Wise\Client\Enums\Build;
use App\Wise\Client\Enums\Country;
use App\Wise\Client\Enums\Status;
use App\Wise\Client\Enums\Type;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

readonly class Player
{
    public function __construct(
        public int $id,
        public string $username,
        public string $displayName,

        #[WithCast(EnumCast::class)]
        public Type $type,

        #[WithCast(EnumCast::class)]
        public Build $build,

        #[WithCast(EnumCast::class)]
        public Status $status,

        #[WithCast(EnumCast::class)]
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
    ){
    }
}
