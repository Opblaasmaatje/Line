<?php

namespace Tests\Unit\Model;

use App\Models\Snapshot;
use Database\Factories\SnapshotFactory;
use Illuminate\Database\UniqueConstraintViolationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class SnapshotTest extends ApplicationCase
{
    #[Test]
    public function it_can_parse_the_player_object_based_on_raw_details()
    {
        /** @var Snapshot $snapshot */
        $snapshot = SnapshotFactory::new()
            ->withFixture('snapshot_details.json')
            ->create([
                'account_id' => 1,
            ]);

        $this->assertSame('sus guy', $snapshot->details->username);
    }

    #[Test]
    public function it_enforces_uniqueness_on_account_id()
    {
        SnapshotFactory::new()->create([
            'raw_details' => [],
            'account_id' => 1,
        ]);

        $this->assertThrows(
            expectedClass: UniqueConstraintViolationException::class,
            test: function () {
                SnapshotFactory::new()->create([
                    'raw_details' => [],
                    'account_id' => 1,
                ]);
            }
        );
    }
}
