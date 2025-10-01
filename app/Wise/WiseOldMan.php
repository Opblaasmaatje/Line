<?php

namespace App\Wise;

use App\Wise\Client\GroupConfiguration;
use Illuminate\Http\Client\PendingRequest;

class WiseOldMan
{
    public function __construct(
        protected PendingRequest $client,
        protected GroupConfiguration $group
    ) {
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
