<?php

namespace App\Wise\Client\Endpoints\Competition;

use App\Wise\Client\Endpoints\Competition\DTO\CompetitionWithParticipations;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\OldMan;
use Brick\JsonMapper\JsonMapper;
use Carbon\CarbonPeriod;

class CompetitionEndpoint
{
    public function __construct(
        protected OldMan $oldMan,
        protected JsonMapper $mapper,
    ) {
    }

    public function createCompetition(
        string $competition,
        Metric $metric,
        CarbonPeriod $period,
    ): CompetitionWithParticipations {
        $data = $this->oldMan->client()->post('competitions', [
            'groupId' => $this->oldMan->getGroup()->getId(),
            'groupVerificationCode' => $this->oldMan->getGroup()->getCode(),
            'title' => $competition,
            'metric' => $metric,
            'startsAt' => $period->getStartDate(),
            'endsAt' => $period->getEndDate(),
        ]);

        return $this->mapper->map($data->body(), CompetitionWithParticipations::class);
    }
}
