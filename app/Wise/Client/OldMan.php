<?php

namespace App\Wise\Client;

use App\Wise\Client\Exceptions\CommunicationException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class OldMan
{
    public function __construct(
        protected PendingRequest $client,
        protected GroupConfiguration $group
    ) {
        $this->client->throw(fn (Response $response) => throw new CommunicationException($response->json('message')));
    }

    public function client(): PendingRequest
    {
        return $this->client;
    }

    public function getGroup(): GroupConfiguration
    {
        return $this->group;
    }
}
