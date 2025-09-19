<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot;

use Illuminate\Support\Collection;

readonly class Data
{
    public function __construct(
        public Skills $skills,
        public Bosses $bosses,
        public Computed $computed,
    ){
    }

    protected function collect(Basket $basket): Collection
    {
        return Collection::make($basket);
    }

    public function collectSkills(): Collection
    {
        return $this->collect($this->skills);
    }

    public function collectBosses(): Collection
    {
        return $this->collect($this->bosses);
    }
}
