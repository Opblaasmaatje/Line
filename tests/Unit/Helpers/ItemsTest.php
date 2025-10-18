<?php

namespace Tests\Unit\Helpers;

use App\Helpers\Items;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class ItemsTest extends ApplicationCase
{
    #[Test]
    public function it_can_get_one_item()
    {
        $outcome = Items::getOne();

        $this->assertArrayHasKey('id', $outcome);
        $this->assertArrayHasKey('name', $outcome);
    }
}
