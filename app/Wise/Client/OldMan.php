<?php

namespace App\Wise\Client;

use App\Wise\Client\Players\WiseOldManException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class OldMan
{
    public function __construct(
        protected PendingRequest $client,
        protected string $apiKey,
        protected int $groupId,
        protected string $groupCode,
    ){
        $this->client->withToken($this->apiKey);

        $this->client->throw(fn(Response $response) => throw new WiseOldManException($response->json('message')));
    }

    public function client(): PendingRequest
    {
        return $this->client;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function getGroupCode(): string
    {
        return $this->groupCode;
    }
}
