<?php

namespace App\Wise\Client\Endpoints\Players;

use App\Models\Account;
use App\Wise\Client\Endpoints\MapsArrayToObjects;
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
    use MapsArrayToObjects;

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

    public function account(Account $account): PlayerSnapshot|false
    {
        $response = $this->oldMan->client()->get("players/id/{$account->external_id}");

        if ($response->failed()) {
            return false;
        }


        /** @var PlayerSnapshot $snapshot */
        $snapshot = $this->mapper->map($response->body(), PlayerSnapshot::class);

        if(! $snapshot->hasSnapshot()){
            return false;
        }

        return $snapshot;
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

        return $this->mapToCollection($response->json(), Player::class);
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

        return $this->mapToCollection($response->json(), Record::class);
    }
}
