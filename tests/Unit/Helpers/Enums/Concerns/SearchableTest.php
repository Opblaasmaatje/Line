<?php

namespace Tests\Unit\Helpers\Enums\Concerns;

use App\Wise\Client\Enums\Metric;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class SearchableTest extends ApplicationCase
{
    #[Test]
    public function it_can_search()
    {
        $this->assertEquals(
            collect([Metric::RANGED]),
            Metric::search('ran'),
        );
    }
}
