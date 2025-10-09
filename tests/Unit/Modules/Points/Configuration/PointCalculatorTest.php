<?php

namespace Tests\Unit\Modules\Points\Configuration;

use App\Modules\Points\Configuration\PointCalculator;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class PointCalculatorTest extends ApplicationCase
{
    #[Test]
    public function it_does_not_calculate_below_zero()
    {
        $sut = new PointCalculator(
            per: 1,
            give: 1
        );

        $this->assertEquals(
            0,
            $sut->calculate(-1)
        );
    }

    #[Test]
    public function it_does_not_throw_division_by_zero()
    {
        $sut = new PointCalculator(
            per: 0,
            give: 0
        );

        $this->assertEquals(
            0,
            $sut->calculate(0)
        );
    }
}
