<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Motivation;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class MotivationTest extends ApplicationCase
{
    #[Test]
    public function it_can_get_the_motivation()
    {
        $value = Motivation::get(
            'some-place-holder'
        );

        $this->assertStringContainsString('some-place-holder', $value);
    }
}
