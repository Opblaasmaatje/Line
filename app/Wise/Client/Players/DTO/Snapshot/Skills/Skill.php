<?php

namespace App\Wise\Client\Players\DTO\Snapshot\Skills;

use App\Wise\Client\Players\DTO\Snapshot\CanGivePoints;
use Illuminate\Contracts\Support\Arrayable;

readonly abstract class Skill implements Arrayable, CanGivePoints
{
    public function __construct(
        public string $metric,
        public int $experience,
        public int $rank,
        public int $level,
        public float $ehp,
    ){
    }

    public function getAmount(): int
    {
        return $this->experience;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
