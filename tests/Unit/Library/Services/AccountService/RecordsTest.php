<?php

namespace Tests\Unit\Library\Services\AccountService;

use App\Library\Services\AccountService;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Record;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Enums\Period;
use Database\Factories\AccountFactory;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class RecordsTest extends ApplicationCase
{
    use HasFixtureAccess;

    #[Test]
    public function it_can_make_an_api_call()
    {
        Http::fake([
            '*' => Http::response($this->getFromFixture('records.json')),
        ]);

        $objects = $this->subjectUnderTesting()->records(
            AccountFactory::new()->create(),
            Metric::RUNECRAFTING,
        );

        /** @var Record $record */
        $record = $objects->first();

        $this->assertEquals(393285, $record->playerId);
        $this->assertEquals(Period::YEAR, $record->period);
        $this->assertEquals(Metric::HUNTER, $record->metric);
        $this->assertEquals(4282480.0, $record->value);
    }

    protected function subjectUnderTesting(): AccountService
    {
        return $this->app->make(AccountService::class);
    }
}
