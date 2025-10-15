<?php

namespace Tests\Unit\Modules\Pets\Library\Services\PetService;

use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\Models\Enums\Status;
use App\Modules\Pets\Models\Pet;
use Database\Factories\PetFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class SetStatusTest extends ApplicationCase
{
    #[Test]
    public function it_can_reject_a_pet()
    {
        /** @var Pet $pet */
        $pet = PetFactory::new()->create();

        $this->subjectUnderTesting()->reject($pet);

        $this->assertSame(Status::REJECTED, $pet->status);
    }

    #[Test]
    public function it_can_approve_a_pet()
    {
        /** @var Pet $pet */
        $pet = PetFactory::new()->create();

        $this->subjectUnderTesting()->approve($pet);

        $this->assertSame(Status::APPROVED, $pet->status);
    }

    protected function subjectUnderTesting(): PetService
    {
        return $this->app->make(PetService::class);
    }
}
