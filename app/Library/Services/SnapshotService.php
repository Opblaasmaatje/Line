<?php

namespace App\Library\Services;

use App\Models\Account;
use App\Wise\Client\Endpoints\Players\PlayerEndpoint;

class SnapshotService
{
    public function __construct(
        protected PlayerEndpoint $client
    ) {
    }

    public function setSnapshot(Account $account): bool
    {
        $data = $this->client->account($account);

        if(! $data){
            return false;
        }

        $account->snapshot->setAttribute(
            key: 'raw_details',
            value: $data->toArray()
        );

        return $account->snapshot->push();
    }
}
