<?php

namespace Tests;

use App\Bingo\Models\Bingo;
use App\Bingo\Models\Objective;
use App\Models\Account;
use Database\Factories\AccountFactory;
use Database\Factories\BingoFactory;
use Database\Factories\ObjectiveFactory;
use Database\Factories\SubmissionFactory;
use Database\Factories\TeamFactory;
use Database\Factories\ThresholdFactory;
use PHPUnit\Framework\Attributes\Test;

class SomethingToTest extends ApplicationCase
{
    #[Test]
    public function it_works()
    {
        /** @var Account $account */
        $account = AccountFactory::new()
            ->set('username', 'sus guy')
            ->set('user_id', 1)
            ->create();

        /** @var Bingo $bingo */
        $bingo = BingoFactory::new()
            ->has(
                TeamFactory::new()
                    ->has(ObjectiveFactory::new())
                    ->hasAttached($account)
            )
            ->has(
                TeamFactory::new()
                    ->has(ObjectiveFactory::new())
                    ->hasAttached($account)
            )
            ->create();

        dd(
            $bingo->objectives,
//            $bingo->teams->first()->objectives,
        );

    }

    #[Test]
    public function test_the_other_thing()
    {
        /** @var Objective $objective */
        $objective = ObjectiveFactory::new()
            ->for(ThresholdFactory::new(), 'task')
            ->create([
                'team_id' => 1,
            ]);

        dd($objective, $objective->task);
    }

    #[Test]
    public function _it_does()
    {
        /** @var Objective $objective */
        $objective = ObjectiveFactory::new()
            ->for(SubmissionFactory::new(), 'task')
            ->create([
                'team_id' => 1,
            ]);

        dd($objective, $objective->task);

    }
}
