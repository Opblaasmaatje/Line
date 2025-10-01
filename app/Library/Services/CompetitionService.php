<?php

namespace App\Library\Services;

use App\Models\Competition;
use App\Wise\Client\Endpoints\Competition\CompetitionEndpoint;
use App\Wise\Client\Enums\Metric;
use Carbon\CarbonPeriod;

class CompetitionService
{
    public function __construct(
        protected CompetitionEndpoint $client
    ) {
    }

    public function create(string $title, Metric $metric, CarbonPeriod $period): Competition
    {
        $response = $this->client->createCompetition(
            $title,
            $metric,
            $period
        );

        return $response->saveModel();
    }

    public function delete(Competition $competition): ?bool
    {
        if(! $this->client->delete($competition->wise_old_man_id)){
            return false;
        }

        return $competition->delete();
    }
}
