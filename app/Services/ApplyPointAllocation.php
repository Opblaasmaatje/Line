<?php

namespace App\Services;

use App\Models\Account;
use App\Points\Facade\PointAllocation;
use Laracord\Services\Service;

class ApplyPointAllocation extends Service
{
    protected int $interval = 5;


    public function handle(): void
    {
        $this->console()->log("Starting point allocation");

        Account::query()->get()->each(function (Account $account){
            $this->console()->log("Queue Jobs for $account->username");

            PointAllocation::boss($account);
            PointAllocation::skill($account);
        });
    }
}
