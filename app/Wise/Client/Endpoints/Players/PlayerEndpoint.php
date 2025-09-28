<?php

namespace App\Wise\Client\Endpoints\Players;

use App\Wise\Client\Endpoints\Players\DTO\PlayerSnapshot;
use App\Wise\Client\OldMan;
use Brick\JsonMapper\JsonMapper;
use Brick\JsonMapper\JsonMapperException;
use Illuminate\Http\Client\ConnectionException;

class PlayerEndpoint
{
    public function __construct(
        protected OldMan $oldMan,
        protected JsonMapper $mapper
    ) {
    }

    /**
     * @throws ConnectionException
     * @throws JsonMapperException
     */
    public function details(string $username): PlayerSnapshot
    {
        $data = $this->oldMan->client()->get("players/$username");

        return $this->mapper->map($data->body(), PlayerSnapshot::class);
    }
}
