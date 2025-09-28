<?php

namespace App\Wise\Client\Endpoints\Players\DTO\Snapshot;

use Illuminate\Contracts\Support\Arrayable;

abstract readonly class Basket implements Arrayable
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
