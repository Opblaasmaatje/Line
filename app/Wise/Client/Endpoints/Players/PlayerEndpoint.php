<?php

namespace App\Wise\Client\Endpoints\Players;

use App\Wise\Client\Endpoints\Players\DTO\PlayerSnapshot;
use App\Wise\Client\Exceptions\CommunicationException;
use App\Wise\WiseOldMan;
use Brick\JsonMapper\JsonMapper;
use Brick\JsonMapper\JsonMapperException;
use Illuminate\Http\Client\ConnectionException;

class PlayerEndpoint
{
    public function __construct(
        protected WiseOldMan $oldMan,
        protected JsonMapper $mapper
    ) {
    }

    /**
     * @throws ConnectionException
     * @throws JsonMapperException
     */
    public function details(string $username): PlayerSnapshot
    {
        $response = $this->oldMan->client()->get("players/$username");

        if($response->failed()){
            throw new CommunicationException($response->body());
        }

        return $this->mapper->map($response->body(), PlayerSnapshot::class);
    }
}
