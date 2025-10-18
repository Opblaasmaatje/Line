<?php

namespace Tests\Unit\Wise\Competition;

use App\Wise\Client\Endpoints\Competition\CompetitionEndpoint;
use App\Wise\Client\Endpoints\Competition\DTO\ParticipantHistory;
use App\Wise\Client\Enums\Metric;
use Carbon\CarbonPeriod;
use Database\Factories\CompetitionFactory;
use Illuminate\Http\Client\Request;
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

        $competitionClient = $this->subjectUnderTesting();

        $mapping = $competitionClient->createCompetition(
            competition: 'test',
            metric: Metric::RUNECRAFTING,
            period: CarbonPeriod::create(
                Carbon::now()->addMinute(),
                Carbon::now()->addMinutes(2)
            ),
        );

        Http::assertSent(
            fn (Request $request) => $request->url() === 'https://api.wiseoldman.net/v2/competitions'
        );

        $this->assertEquals('581-255-315', $mapping->verificationCode);
    }

    #[Test]
    public function it_makes_an_api_call_to_get_the_top_competitors()
    {
        Http::fake([
            '*' => Http::response($this->getFromFixture('top_competitors.json')),
        ]);

        $competition = CompetitionFactory::new()->create();

        $mapping = $this->subjectUnderTesting()->topParticipants(
            $competition,
            Metric::RUNECRAFTING,
        );


        dd($mapping);
        
        Http::assertSent(
            fn (Request $request) => $request->url() === "https://api.wiseoldman.net/v2/competitions/{$competition->wise_old_man_id}/top-history?metric=runecrafting"
        );

        $this->assertInstanceOf(ParticipantHistory::class, $mapping->first());
    }

    protected function subjectUnderTesting(): CompetitionEndpoint
    {
        return App::make(CompetitionEndpoint::class);
    }
}
