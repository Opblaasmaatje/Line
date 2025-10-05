<?php

namespace App\Wise\Client\Endpoints\Players;

use App\Wise\Client\Endpoints\Players\DTO\Player;
use App\Wise\Client\Endpoints\Players\DTO\PlayerSnapshot;
use App\Wise\Client\Exceptions\CommunicationException;
use App\Wise\WiseOldMan;
use Brick\JsonMapper\JsonMapper;
use Brick\JsonMapper\JsonMapperException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;

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
    public function details(string $username): PlayerSnapshot|false
    {
        $response = $this->oldMan->client()->get("players/$username");

        if ($response->failed()) {
            return false;
        }

        return $this->mapper->map($response->body(), PlayerSnapshot::class);
    }

    /**
     * @param string $username
     * @param int $limit
     * @return Collection<Player>|false
     */
    public function search(string $username, int $limit = 25): Collection|false
    {
        $response = $this->oldMan->client()->get('/players/search', [
            'username' => $username,
            'limit' => $limit
        ]);

        if ($response->failed()) {
            return false;
        }

        return Collection::make(
            json_decode($response->body(), true)
        )->map(
            fn(array $value) => $this->mapper->map(json_encode($value), Player::class)
        );
    }
}
