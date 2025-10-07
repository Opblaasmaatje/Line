<?php

namespace App\Wise\Client\Endpoints;

use Illuminate\Support\Collection;

trait MapsArrayToObjects
{
    /**
     * @param class-string $className
     */
    protected function mapToCollection(array $data, string $className): Collection
    {
        return Collection::make($data)->map(
            fn (array $value) => $this->mapper->map(json_encode($value), $className)
        );
    }
}
