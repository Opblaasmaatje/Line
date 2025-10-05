<?php

namespace Tests\Unit\Enums;

use App\Helpers\Enums\Searchable;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

enum StubEnum: string
{
    use Searchable;

    case AD = 'AD';

    case OP = 'OP';

    public function toTitle(): string
    {
        return $this->name;
    }
}

class SearchableTest extends ApplicationCase
{
    #[Test]
    public function it_can_search()
    {
        // TODO create tests

    }
}
