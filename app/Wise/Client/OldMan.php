<?php

namespace App\Wise\Client;

use App\Wise\Client\Players\WiseOldManException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class OldMan
{
    public function __construct(
        public PendingRequest $client,
        public string $apiKey
    ){
        $this->client->withToken($this->apiKey);

        $this->client->throw(fn(Response $response) => throw new WiseOldManException($response->json('message')));
    }

    public function client()
    {
        return $this->client;
    }
}
