<?php

namespace Tests\Unit\Points;

use App\Points\Facade\PointAllocation;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class PointAllocationTest extends ApplicationCase
{
    #[Test]
    public function it_is_a_facade()
    {
        $this->assertInstanceOf(Facade::class, new PointAllocation());
    }
}
