<?php

namespace App\Wise\Client\Competition;

use App\Wise\Client\Competition\DTO\CompetitionWithParticipations;
use App\Wise\Client\Enums\Metric;
use App\Wise\Client\OldMan;
use Brick\JsonMapper\JsonMapper;
use Illuminate\Support\Carbon;

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
        Carbon $startsAt,
        Carbon $endsAt,
    ) {
        $data = $this->oldMan->client()->post("competitions", [
            'groupId' => $this->oldMan->getGroupId(),
            'groupVerificationCode' => $this->oldMan->getGroupCode(),
            'title' => $competition,
            'metric' => $metric,
            'startsAt' => $startsAt,
            'endsAt' => $endsAt,
        ]);

        return $this->mapper->map($data->body(), CompetitionWithParticipations::class);
    }
}
