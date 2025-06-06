<?php

namespace App\Wise\Client;

use App\Wise\Client\Exceptions\WiseOldManException;
use Illuminate\Http\Client\PendingRequest;

class OldMan
{
    public function __construct(
        public PendingRequest $client,
        public string $apiKey
    ){
        $this->client->withToken($this->apiKey);

        $this->client->throw(fn() => throw new WiseOldManException());
    }

    public function client()
    {
        return $this->client;
    }
}
