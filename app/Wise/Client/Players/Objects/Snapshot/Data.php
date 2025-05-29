<?php

namespace App\Wise\Client\Players\Objects\Snapshot;

readonly class Data
{

    public function __construct(
        public Skills $skills,
        public Bosses $bosses,
        public Computed $computed,
    ){
    }
}
