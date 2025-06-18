<?php

namespace Tests\Unit\Wise\Competition;

use App\Wise\Client\Competition\CompetitionClient;
use App\Wise\Client\Players\WiseOldManException;
use Illuminate\Support\Facades\App;
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
        Http::fake([
            'api.wiseoldman.net/*' => Http::response($this->getFromFixture('create_competition.json'), 200),
        ]);

        /** @var CompetitionClient $competitionClient */
        $competitionClient = App::make(CompetitionClient::class);
        $data = $competitionClient->createCompetition('test');

        $this->assertTrue(true);
    }

    #[Test]
    public function it_throws_wiseoldmanexception_upon_failure()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response(null, 500),
        ]);

        /** @var CompetitionClient $competitionClient */
        $competitionClient = App::make(CompetitionClient::class);

        $this->assertThrows(function () use ($competitionClient) {
            $competitionClient->createCompetition('test');
        }, WiseOldManException::class);
    }
}
