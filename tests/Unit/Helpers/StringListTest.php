<?php

namespace Tests\Unit\Helpers;

use App\Helpers\StringList;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class StringListTest extends ApplicationCase
{
    public static function stringFormats(): array
    {
        return [
            'Happy path' => [
                '
                a
                b
                c
                ',
                ['a', 'b', 'c'],
            ],
            'With whitespace' => [
                '
                a

                c
                ',
                ['a', 'c'],
            ],
            'Empty string' => [
                '',
                [],
            ],
            'Null value' => [
                null,
                [],
            ],
        ];
    }

    #[Test]
    #[DataProvider('stringFormats')]
    public function it_can_format_to_array(string|null $value, array $assertion)
    {
        $array = StringList::format($value);

        $this->assertSame($assertion, $array);
    }
}
