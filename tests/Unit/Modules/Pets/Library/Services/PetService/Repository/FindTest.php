<?php

namespace Tests\Unit\Modules\Pets\Library\Services\PetService\Repository;

use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\Models\Enums\Status;
use Database\Factories\PetFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Modules\Pets\Helpers\TestsPetStatuses;

class FindTest extends ApplicationCase
{
    use TestsPetStatuses;

    #[Test]
    #[DataProvider('statuses')]
    public function it_can_find_a_pet(Status $status)
    {
        $pet = PetFactory::new()->create([
            'status' => $status,
        ]);

        $this->assertTrue(
            $pet->is($this->subjectUnderTesting()->repository->find($pet->getKey())),
        );
    }

    protected function subjectUnderTesting(): PetService
    {
        return $this->app->make(PetService::class);
    }
}
