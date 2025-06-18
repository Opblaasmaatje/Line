<?php

namespace Tests\Unit\Wise\Competition;

use App\Wise\Client\Competition\CompetitionClient;
use Illuminate\Support\Facades\App;
use Tests\ApplicationCase;

class TestItWorks extends ApplicationCase
{
    public function test_it_works()
    {
        /** @var CompetitionClient $competitionClient */
        $competitionClient = App::make(CompetitionClient::class);
        $competitionClient->createCompetition('test');
    }
}
