<?php

namespace Tests\Unit\Modules\Points\Jobs;

use App\Modules\Points\Jobs\AssignPoints;
use App\Modules\Points\Models\Point;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Skills\Construction;
use App\Wise\Client\Enums\Metric;
use Database\Factories\AccountFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class AssignPointsTest extends ApplicationCase
{
    #[Test]
    public function it_calls_run_when_applying()
    {
        $account = AccountFactory::new()->create();

        /** @var AssignPoints $sut */
        $sut = App::make(AssignPoints::class);

        $sut->apply($account, Collection::make([
            new Construction(Metric::CONSTRUCTION, 1, 1, 1, 1),
        ]));

        $this->assertDatabaseHas(Point::class, [
            'source' => Metric::CONSTRUCTION,
            'amount' => 0,
            'account_id' => $account->getKey(),
        ]);

    }
}
