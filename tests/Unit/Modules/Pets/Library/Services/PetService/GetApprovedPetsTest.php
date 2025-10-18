<?php

namespace Tests\Unit\Modules\Pets\Library\Services\PetService;

use App\Modules\Pets\Library\AcquiredPets\AcquiredPet;
use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use Database\Factories\AccountFactory;
use Database\Factories\PetFactory;
use Database\Factories\UserFactory;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class GetApprovedPetsTest extends ApplicationCase
{
    #[Test]
    public function it_formats_it_correctly()
    {
        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->has(PetFactory::new()->approved()->count(4))
            ->create();

        $acquiredPets = $this->subjectUnderTesting()->getAcquiredPets($account);

        $this->assertCount(4, $acquiredPets->onlyGotten());

        $this->assertCount(count(PetName::cases()) - 4, $acquiredPets->onlyYetToGet());
    }

    #[Test]
    public function it_applies_to_the_correct_name()
    {
        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->has(PetFactory::new([
                'name' => PetName::PET_ZILYANA,
            ])->approved())
            ->create();

        $acquiredPets = $this->subjectUnderTesting()->getAcquiredPets($account);

        /** @var AcquiredPet $acquiredPet */
        $acquiredPet = $acquiredPets->onlyGotten()->sole();

        $this->assertSame(PetName::PET_ZILYANA, $acquiredPet->name);
        $this->assertTrue($acquiredPet->acquired);
    }

    #[Test]
    public function it_gracefully_handles_when_you_have_multiple_of_the_same_pet()
    {
        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->has(PetFactory::new([
                'name' => PetName::PET_KRAKEN,
            ])->approved())
            ->has(PetFactory::new([
                'name' => PetName::PET_KRAKEN,
            ])->approved())
            ->create();

        $acquiredPets = $this->subjectUnderTesting()->getAcquiredPets($account);

        $this->assertCount(1, $acquiredPets->onlyGotten());

        $this->assertCount(count(PetName::cases()) - 1, $acquiredPets->onlyYetToGet());
    }

    #[Test]
    public function it_ignores_invalid_statuses()
    {
        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->has(PetFactory::new([
                'status' => Status::IN_PROCESS,
            ]))
            ->has(PetFactory::new([
                'status' => Status::REJECTED,
            ]))
            ->create();

        $acquiredPets = $this->subjectUnderTesting()->getAcquiredPets($account);

        $this->assertCount(0, $acquiredPets->onlyGotten());

        $this->assertCount(count(PetName::cases()), $acquiredPets->onlyYetToGet());
    }

    protected function subjectUnderTesting(): PetService
    {
        return $this->app->make(PetService::class);
    }
}
