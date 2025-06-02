<?php

namespace Tests\Unit\Points\Jobs\Action;

use App\Models\Account;
use App\Models\Point;
use App\Points\Bosses\Jobs\Action\GiveBossPointsAction;
use App\Points\Configuration\PointAllocationConfiguration;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use App\Wise\Client\Players\Objects\Snapshot\Bosses\CommanderZilyana;
use Database\Factories\AccountFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class GivePointsActionTest extends ApplicationCase
{
    #[Test]
    public function it_gives_points()
    {
        /** @var Account $account */
        $account = AccountFactory::new()->create([
            'user_id' => 1,
        ]);

        $boss = new CommanderZilyana(
            'commander_zilyana',
            2,
            1,
            1,
        );

        $sut = new GiveBossPointsAction(
            new PointAllocationConfiguration([
                Boss::class => [
                    'per' => 1,
                    'give' => 1,
                ]
            ])
        );

        $sut->run($account, $boss);

        /** @var Point $point */
        $point = $account->refresh()->points->sole();

        $this->assertSame(
            2,
            $point->amount,
        );

        $this->assertSame(
            'commander_zilyana',
            $point->source,
        );
    }

}
