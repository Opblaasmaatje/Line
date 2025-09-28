<?php

namespace App\Library\Services;

use App\Models\Account;
use App\Wise\Client\Endpoints\Players\PlayerEndpoint;

//TODO create test
class SnapshotService
{
    public function __construct(
        protected PlayerEndpoint $client
    ){
    }

    public function setSnapshot(Account $account): bool
    {
        return rescue(function () use ($account) {
            $account->snapshot->setAttribute(
                key: 'raw_details',
                value: $this->client->details($account->username)->toArray()
            );

            return $account->snapshot->push();
        }, false);
    }
}
