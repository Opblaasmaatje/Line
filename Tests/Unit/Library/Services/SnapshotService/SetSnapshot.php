<?php

namespace Tests\Unit\Library\Services\SnapshotService;

use App\Library\Services\SnapshotService;
use Database\Factories\AccountFactory;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class SetSnapshot extends ApplicationCase
{
    use HasFixtureAccess;

    #[Test]
    public function it_can_create_a_snapshot()
    {
        Http::fake([
            '*' => Http::response($this->getFromFixture('snapshot_details.json')),
        ]);

        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->create();

        $success = $this->subjectUnderTesting()->setSnapshot($account);

        $this->assertTrue($success);

        $this->assertIsArray($account->refresh()->snapshot->raw_details);
    }

    protected function subjectUnderTesting(): SnapshotService
    {
        return $this->app->make(SnapshotService::class);
    }
}
