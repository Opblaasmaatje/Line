<?php

namespace Tests\Unit\Helpers\Enums\Concerns;

use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Enums\Period;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class AsHeadlineTest extends ApplicationCase
{
    public static function enums(): array
    {
        return [
            ...collect(Metric::cases())->map(fn (Metric $metric) => [$metric]),
            ...collect(Period::cases())->map(fn (Period $period) => [$period]),
        ];
    }

    #[Test]
    #[DataProvider('enums')]
    public function it_can_instantiate_from_headline(Metric|Period $metric)
    {

        $this->assertSame(
            Str::headline($metric->value),
            $metric->toHeadline()
        );

        $this->assertInstanceOf(
            $metric::class,
            $metric::fromHeadline($metric->toHeadline())
        );
    }
}
