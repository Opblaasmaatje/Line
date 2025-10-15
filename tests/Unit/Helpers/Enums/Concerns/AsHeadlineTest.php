<?php

namespace Tests\Unit\Helpers\Enums\Concerns;

use App\Helpers\Enums\Contracts\CanHeadline;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Enums\Period;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Spatie\StructureDiscoverer\Discover;
use Tests\ApplicationCase;

class AsHeadlineTest extends ApplicationCase
{
    public static function enums(): array
    {
        return [
            ...collect(
                Discover::in(realpath(__DIR__.'/../../../../../app'))
                    ->enums()
                    ->implementing(CanHeadline::class)
                    ->get()
            )
                ->map(fn (string $enumClass) => $enumClass::cases())
                ->flatten()
                ->map(fn (CanHeadline $canHeadline) => [$canHeadline])
                ->toArray(),
        ];
    }

    #[Test]
    #[DataProvider('enums')]
    public function it_can_instantiate_from_headline(CanHeadline|Metric|Period $canHeadlineEnum)
    {
        $this->assertSame(
            Str::headline($canHeadlineEnum->value),
            $canHeadlineEnum->toHeadline()
        );

        $this->assertInstanceOf(
            $canHeadlineEnum::class,
            $canHeadlineEnum::fromHeadline($canHeadlineEnum->toHeadline())
        );
    }
}
