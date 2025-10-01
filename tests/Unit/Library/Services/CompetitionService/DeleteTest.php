<?php

namespace Tests\Unit\Library\Services\CompetitionService;

use App\Library\Services\CompetitionService;
use Database\Factories\CompetitionFactory;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class DeleteTest extends ApplicationCase
{
    #[Test]
    public function it_can_delete_a_competition()
    {
        Http::fake([
            '*' => Http::response(null, 204),
        ]);

        $competition = CompetitionFactory::new()->create();

        $success = $this->subjectUnderTesting()->delete($competition);

        $this->assertTrue($success);

        $this->assertModelMissing($competition);
    }

    #[Test]
    public function it_returns_false_and_does_not_delete_model_when_api_fails()
    {
        Http::fake([
            '*' => Http::response(null, 500),
        ]);

        $competition = CompetitionFactory::new()->create();

        $success = $this->subjectUnderTesting()->delete($competition);

        $this->assertFalse($success);

        $this->assertModelExists($competition);
    }

    protected function subjectUnderTesting(): CompetitionService
    {
        return $this->app->make(CompetitionService::class);
    }
}
