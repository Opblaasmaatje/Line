<?php

namespace App\Wise\Client\Endpoints\Players;

use App\Wise\Client\Endpoints\Players\DTO\Player;
use App\Wise\Client\Endpoints\Players\DTO\PlayerSnapshot;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Record;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Enums\Period;
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
     * @return Collection<Player>|false
     */
    public function search(string $username, int $limit = 25): Collection|false
    {
        $response = $this->oldMan->client()->get('/players/search', [
            'username' => $username,
            'limit' => $limit,
        ]);

        if ($response->failed()) {
            return false;
        }

        return $this->mapFromCollection($response->json(), Player::class);
    }

    public function records(string $username, Metric|null $metric, Period|null $period): Collection|false
    {
        $response = $this->oldMan->client()->get("/players/{$username}/records", [
            'metric' => $metric,
            'period' => $period,
        ]);

        if ($response->failed()) {
            return false;
        }

        return $this->mapFromCollection($response->json(), Record::class);
    }

    /**
     * @param class-string $className
     */
    protected function mapFromCollection(array $data, string $className): Collection
    {
        return Collection::make($data)->map(
            fn (array $value) => $this->mapper->map(json_encode($value), $className)
        );
    }
}
