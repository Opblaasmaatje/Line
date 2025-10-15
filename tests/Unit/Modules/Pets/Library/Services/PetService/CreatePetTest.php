<?php

namespace Tests\Unit\Modules\Pets\Library\Services\PetService;

use App\Models\Account;
use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\Models\Enums\PetName;
use Database\Factories\AccountFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Modules\Pets\Helpers\TestsPetNames;

class CreatePetTest extends ApplicationCase
{
    use TestsPetNames;

    #[Test]
    #[DataProvider('pets')]
    public function it_can_create_a_pet(PetName $petName)
    {
        /** @var Account $account */
        $account = AccountFactory::new()->create();

        $pet = $this->subjectUnderTesting()->createPet(
            $account,
            $petName,
            'some-url.com'
        );

        $this->assertModelExists($pet);

        $this->assertTrue($account->pets->contains($pet));
    }

    protected function subjectUnderTesting(): PetService
    {
        return $this->app->make(PetService::class);
    }
}
