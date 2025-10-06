<?php

namespace Tests\Unit\Points;

use App\Models\Account;
use App\Models\Point;
use App\Points\PointAllocator;
use Database\Factories\AccountFactory;
use Database\Factories\SnapshotFactory;
use PharIo\Manifest\Application;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class PointAllocatorTest extends ApplicationCase
{
    #[Test]
    public function it_can_allocate_skills()
    {
        $snapshot = SnapshotFactory::new()
            ->for(AccountFactory::new())
            ->withFixture('snapshot_details.json')
            ->create();

        $this->subjectUnderTesting()->skill($snapshot);
        $this->subjectUnderTesting()->boss($snapshot);

        $this->assertDatabaseCount(Point::class, $snapshot->account->points->count());
    }

    #[Test]
    public function it_can_allocate_bosses()
    {
        $snapshot = SnapshotFactory::new()
            ->for(AccountFactory::new())
            ->withFixture('snapshot_details.json')
            ->create();

        $this->subjectUnderTesting()->boss($snapshot);

        $this->assertDatabaseCount(Point::class, $snapshot->account->points->count());
    }

    protected function subjectUnderTesting(): PointAllocator
    {
        return $this->app->make(PointAllocator::class);
    }
}
