<?php

namespace Tests\Unit\Points\Jobs;

use App\Models\Point;
use App\Points\Jobs\Actions\ApplyPoints;
use App\Points\Jobs\AssignPoints;
use App\Wise\Client\Players\DTO\Snapshot\Bosses\CommanderZilyana;
use App\Wise\Client\Players\DTO\Snapshot\Skills\Construction;
use Database\Factories\AccountFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Mockery\Mock;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class AssignPointsClass extends ApplicationCase
{


    /**
     * TODO figure out why mocking is not working
     *
     * @return void
     */
    #[Test]
    public function it_calls_run_when()
    {
        $account = AccountFactory::new()->create([
            'id' => 69,
            'user_id' => 69,
        ]);

        /** @var AssignPoints $sut */
        $sut = App::make(AssignPoints::class);

        $sut->apply($account, Collection::make([
            new Construction('construction', 1, 1, 1, 1)
        ]));

        $this->assertDatabaseHas(Point::class, [
            'id' => 1,
            'account_id' => 69,
        ]);


    }
}
