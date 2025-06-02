<?php

namespace Tests\Unit\Points\Jobs\Action;

use App\Models\Account;
use App\Models\Point;
use App\Points\Jobs\Actions\ApplyPoints;
use Database\Factories\AccountFactory;
use Database\Factories\PointFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class ApplyPointsTest extends ApplicationCase
{
    #[Test]
    public function it_gives_points()
    {
        /** @var Account $account */
        $account = AccountFactory::new()->create([
            'user_id' => 1,
        ]);

        $sut = new ApplyPoints();

        $sut->run(
            $account,
            'some-metric',
            23
        );

        /** @var Point $point */
        $point = $account->refresh()->points->sole();

        $this->assertSame(
            23,
            $point->amount,
        );

        $this->assertSame(
            'some-metric',
            $point->source,
        );
    }

    #[Test]
    public function it_overwrites_when_same_metric()
    {
        {
            /** @var Account $account */
            $account = AccountFactory::new()->create([
                'user_id' => 1,
            ]);

            $sut = new ApplyPoints();

            //When called twice
            $sut->run(
                account: $account,
                metric: 'some-metric',
                amount: 23
            )->run(
                account: $account,
                metric: 'some-metric',
                amount: 26
            );

            /** @var Point $point */
            $point = $account->refresh()->points->sole();

            $this->assertSame(
                26,
                $point->amount,
            );

            $this->assertSame(
                'some-metric',
                $point->source,
            );
        }
    }

    #[Test]
    public function it_does_not_overwrite_source_when_using_different_account()
    {
        AccountFactory::new()
            ->has(PointFactory::new(['source' => 'this-one!']))
            ->create(['user_id' => 1]);

        $account = AccountFactory::new()
            ->create(['user_id' => 2]);


        $this->assertDatabaseCount(Account::class, 2);

        $sut = new ApplyPoints();

        $sut->run(
            account: $account,
            metric: 'this-one!',
            amount: 1,
        );

        $this->assertDatabaseCount(Point::class, 2);
    }
}
