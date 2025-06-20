<?php

namespace App\Wise\Client;

use App\Wise\Client\Exceptions\CommunicationException;
use App\Wise\Client\Exceptions\ConfigurationException;
use App\Wise\Client\Exceptions\WiseOldManException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class OldMan
{
    protected int $groupId;

    protected string $groupCode;

    public function __construct(
        protected PendingRequest $client,
    ){
        $this->client->throw(fn(Response $response) => throw new CommunicationException($response->json('message')));
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

    /**
     * @throws WiseOldManException
     */
    public function setGroupId(int|null $groupId): self
    {
        if(is_null($groupId)){
            throw new ConfigurationException('Invalid group id');
        }

        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @throws WiseOldManException
     */
    public function setGroupCode(string|null $groupCode): self
    {
        if(is_null($groupCode)){
            throw new ConfigurationException('Invalid group code');
        }

        $this->groupCode = $groupCode;

        return $this;
    }
}
