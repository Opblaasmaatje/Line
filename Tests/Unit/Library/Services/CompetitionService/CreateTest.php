<?php

namespace Tests\Unit\Library\Services\CompetitionService;

use App\Library\Services\CompetitionService;
use App\Models\Competition;
use App\Wise\Client\Enums\Metric;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class CreateTest extends ApplicationCase
{
    use HasFixtureAccess;

    #[Test]
    public function it_can_create_a_competition_with_model()
    {
        Http::fake([
            '*' => Http::response($this->getFromFixture('create_competition.json'), 200),
        ]);

        Carbon::setTestNow();

        $model = $this->subjectUnderTesting()->create(
            'test',
            Metric::ATTACK,
            CarbonPeriod::create(
                Carbon::now(),
                Carbon::now()->addDay(),
            )
        );

        $this->assertDatabaseHas(Competition::class, [
            'id' => $model->id,
            'wise_old_man_id' => '94285',
            'title' => 'test',
            'metric' => Metric::ATTACK,
            'starts_at' => '2025-06-18 09:44:01',
            'ends_at' => '2025-06-18 09:46:01',
            'verification_code' => '581-255-315',
        ]);
    }

    protected function subjectUnderTesting(): CompetitionService
    {
        return $this->app->make(CompetitionService::class);
    }
}
