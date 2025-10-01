<?php

namespace Tests\Unit\Wise\Competition\DTO;

use App\Models\Competition;
use App\Wise\Client\Endpoints\Competition\DTO\CompetitionWithParticipations;
use Brick\JsonMapper\JsonMapper;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class CompetitionWithParticipationsTest extends ApplicationCase
{
    use HasFixtureAccess;

    #[Test]
    public function it_create_a_model()
    {
        $subject = $this->mapper()->map($this->getFromFixture('create_competition.json'), CompetitionWithParticipations::class);

        $model = $subject->saveModel();



        $this->assertDatabaseHas(Competition::class, $model->toArray());
    }

    protected function mapper(): JsonMapper
    {
        return $this->app->make(JsonMapper::class);
    }
}
