<?php

namespace Tests\Unit\Wise\Competition;

use App\Wise\Client\Endpoints\Competition\CompetitionEndpoint;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Exceptions\CommunicationException;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class CompetitionEndpointTest extends ApplicationCase
{
    use HasFixtureAccess;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('wise-old-man.group-code', 'group-code');
        Config::set('wise-old-man.group-id', 111);
    }

    #[Test]
    public function it_makes_an_api_call_and_create_a_competition()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response($this->getFromFixture('create_competition.json'), 200),
        ]);

        /** @var CompetitionEndpoint $competitionClient */
        $competitionClient = App::make(CompetitionEndpoint::class);

        $mapping = $competitionClient->createCompetition(
            competition: 'test',
            metric: Metric::RUNECRAFTING,
            period: CarbonPeriod::create(
                Carbon::now()->addMinute(),
                Carbon::now()->addMinutes(2)
            ),
        );

        $this->assertEquals('581-255-315', $mapping->verificationCode);
    }

    #[Test]
    public function it_throws_wise_old_man_exception_upon_failure()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response(null, 500),
        ]);

        /** @var CompetitionEndpoint $competitionClient */
        $competitionClient = App::make(CompetitionEndpoint::class);

        $this->assertThrows(function () use ($competitionClient) {
            $competitionClient->createCompetition(
                competition: 'test',
                metric: Metric::RUNECRAFTING,
                period: CarbonPeriod::create(
                    Carbon::now()->addMinute(),
                    Carbon::now()->addMinutes(2)
                ),
            );
        }, CommunicationException::class);
    }
}
