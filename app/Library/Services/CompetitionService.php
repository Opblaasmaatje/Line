<?php

namespace App\Library\Services;

use App\Models\Competition;
use App\Wise\Client\Endpoints\Competition\CompetitionEndpoint;
use App\Wise\Client\Enums\Metric;
use Carbon\CarbonPeriod;

//TODO create test
class CompetitionService
{
    public function __construct(
        protected CompetitionEndpoint $client
    ){
    }

    public function create(string $competition, Metric $metric, CarbonPeriod $period): Competition
    {
        $response = $this->client->createCompetition(
            $competition,
            $metric,
            $period
        );

        return $response->saveModel();
    }
}
