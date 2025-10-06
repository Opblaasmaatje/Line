<?php

namespace App\Library\Services;

use App\Library\Repository\CompetitionRepository;
use App\Models\Competition;
use App\Wise\Client\Endpoints\Competition\CompetitionEndpoint;
use App\Wise\Client\Enums\Metric;
use Carbon\CarbonPeriod;

class CompetitionService
{
    public function __construct(
        protected CompetitionEndpoint $client,
        protected CompetitionRepository $repository
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

    public function delete(Competition|string $competition): ?bool
    {
        $model = $this->repository->byTitle($competition);

        if (is_null($model)) {
            return false;
        }

        if (! $this->client->delete($model->wise_old_man_id)) {
            return false;
        }

        return $model->delete();
    }
}
