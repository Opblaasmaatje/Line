<?php

namespace App\Wise\Client\Endpoints\Competition;

use App\Models\Competition;
use App\Wise\Client\Endpoints\Competition\DTO\CompetitionWithParticipations;
use App\Wise\Client\Endpoints\Competition\DTO\ParticipantHistory;
use App\Wise\Client\Endpoints\MapsArrayToObjects;
use App\Wise\Client\Enums\Metric;
use App\Wise\WiseOldMan;
use Brick\JsonMapper\JsonMapper;
use Carbon\CarbonPeriod;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Collection;

class CompetitionEndpoint
{
    use MapsArrayToObjects;

    public function __construct(
        protected WiseOldMan $oldMan,
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

    public function delete(string $id): bool
    {
        return $this->oldMan
            ->client()
            ->delete("competitions/{$id}", [
                'verificationCode' => $this->oldMan->getGroup()->getCode(),
            ])
            ->successful();
    }

    /**
     * @return Collection<ParticipantHistory>
     */
    public function topParticipants(Competition $competition, Metric $metric): Collection
    {
        $data = $this->oldMan->client()->get("competitions/{$competition->wise_old_man_id}/top-history", [
            'metric' => $metric,
        ]);

        return $this->mapToCollection($data->json(), ParticipantHistory::class);
    }
}
