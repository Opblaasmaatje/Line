<?php

namespace Tests\Unit\Wise\Competition;

use App\Wise\Client\Competition\CompetitionClient;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\Exceptions\CommunicationException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class CompetitionClientTest extends ApplicationCase
{
    use HasFixtureAccess;

    #[Test]
    public function it_makes_an_api_call_and_create_a_competition()
    {
        Config::set('wise.old-man.group-code', 'group-code');
        Config::set('wise.old-man.group-id', 111);

        Http::fake([
            'api.wiseoldman.net/*' => Http::response($this->getFromFixture('create_competition.json'), 200),
        ]);

        /** @var CompetitionClient $competitionClient */
        $competitionClient = App::make(CompetitionClient::class);

        $data = $competitionClient->createCompetition(
            competition: 'test',
            metric: Metric::RUNECRAFTING,
            startsAt: Carbon::now()->addMinute(),
            endsAt: Carbon::now()->addMinutes(2)
        );

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_wiseold_man_exception_upon_failure()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response(null, 500),
        ]);

        /** @var CompetitionClient $competitionClient */
        $competitionClient = App::make(CompetitionClient::class);

        $this->assertThrows(function () use ($competitionClient) {
            $competitionClient->createCompetition(
                competition: 'test',
                metric: Metric::RUNECRAFTING,
                startsAt: Carbon::now()->addMinute(),
                endsAt: Carbon::now()->addMinutes(2)
            );
        }, CommunicationException::class);
    }

    public function test_it_works()
    {
        /** @var CompetitionClient $client */
        $client = App::make(CompetitionClient::class);

        $this->markTestIncomplete();

        return;

        $client->createCompetition(
            competition: 'test',
            metric: Metric::RUNECRAFTING,
            startsAt: Carbon::now()->addMinute(),
            endsAt: Carbon::now()->addMinutes(2)
        );
    }
}
