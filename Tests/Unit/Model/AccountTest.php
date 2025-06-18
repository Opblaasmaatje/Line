<?php

namespace Tests\Unit\Model;

use App\Models\Account;
use Database\Factories\AccountFactory;
use Database\Factories\PointFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class AccountTest extends ApplicationCase
{
    #[Test]
    public function it_can_sum_up_total_amount_of_points()
    {
        /** @var Account $account */
        $account = AccountFactory::new()
            ->has(PointFactory::new([
                'amount' => 4,
            ]))
            ->has(PointFactory::new([
                'amount' => 2,
            ]))
            ->create([
                'user_id' => 1,
            ]);

        $this->assertSame(6, $account->total_points);
    }
}
