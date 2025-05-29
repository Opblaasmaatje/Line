<?php

namespace App\Wise\Client\Players\Objects\Snapshot;

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

    public function collectSkills()
    {
        return $this->collect($this->skills);
    }

    public function collectBosses()
    {
        return $this->collect($this->bosses);
    }
}
