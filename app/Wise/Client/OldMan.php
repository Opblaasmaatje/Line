<?php

namespace App\Wise\Client;

use Illuminate\Http\Client\PendingRequest;

class OldMan
{
    public function __construct(
        public PendingRequest $client,
        public string $apiKey
    ){
        $this->client->withToken($this->apiKey);
    }

    public function client()
    {
//        app('bot')->console()->log('Using the WiseOldMan API');

        return $this->client;
    }
}
