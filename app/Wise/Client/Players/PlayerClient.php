<?php

namespace App\Wise\Client\Players;

use App\Wise\Client\OldMan;
use App\Wise\Client\Players\Objects\Player;
use Brick\JsonMapper\JsonMapper;
use Brick\JsonMapper\JsonMapperException;
use Illuminate\Http\Client\ConnectionException;

class PlayerClient
{
    public function __construct(
        protected OldMan $oldMan,
        protected JsonMapper $mapper
    ){
    }

    /**
     * @throws ConnectionException
     * @throws JsonMapperException
     */
    public function details(string $username): Player
    {
        $data = $this->oldMan->client()->get("players/$username");

        dd($data->json());

        return $this->mapper->map($data->body(), Player::class);
    }
}
