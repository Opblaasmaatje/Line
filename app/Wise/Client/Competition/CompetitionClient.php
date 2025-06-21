<?php

namespace App\Wise\Client\Competition;

use App\Wise\Client\Competition\DTO\CompetitionWithParticipations;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\OldMan;
use Brick\JsonMapper\JsonMapper;
use Carbon\CarbonPeriod;

class CompetitionClient
{
    public function __construct(
        protected OldMan $oldMan,
        protected JsonMapper $mapper
    ) {
    }

    public function createCompetition(
        string $competition,
        Metric $metric,
        CarbonPeriod $period,
    ) {
        $data = $this->oldMan->client()->post("competitions", [
            'groupId' => $this->oldMan->getGroupId(),
            'groupVerificationCode' => $this->oldMan->getGroupCode(),
            'title' => $competition,
            'metric' => $metric,
            'startsAt' => $period->getStartDate(),
            'endsAt' => $period->getEndDate(),
        ]);

        return $this->mapper->map($data->body(), CompetitionWithParticipations::class);
    }
}
