<?php

namespace Tests;

use App\Bingo\Models\Bingo;
use App\Bingo\Models\Team;
use App\Models\Account;
use Database\Factories\AccountFactory;
use Database\Factories\BingoFactory;
use Database\Factories\ObjectiveFactory;
use Database\Factories\TeamFactory;
use PHPUnit\Framework\Attributes\Test;

class SomethingToTest extends ApplicationCase
{
    #[Test]
    public function it_works()
    {
        /** @var  Account $account */
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
}
