<?php

namespace App\Services;

use App\Models\Account;
use App\Wise\Client\Players\Objects\Snapshot\Skills\Skill;
use Laracord\Services\Service;

class QueueTokenDistribution extends Service
{
    protected int $interval = 5;

    public function handle(): mixed
    {

        Account::query()->get()->each(function (Account $account){

            $this->console()->log("Updating $account->username");

            $maxedSkills = $account->details
                ->latestSnapshot
                ->data
                ->collectSkills()
                ->filter(fn(Skill $skill) => $skill->level === 99)
                ->count();

                $account->tokens = $maxedSkills * 10;

                $account->save();
        });

        return null;
    }
}
