<?php

namespace Tests\Unit\Modules\Pets\Library\Services\PetService;

use App\Modules\Pets\Library\Services\PetService;
use App\Modules\Pets\Models\Enums\PetName;
use App\Modules\Pets\Models\Enums\Status;
use Database\Factories\AccountFactory;
use Database\Factories\PetFactory;
use Database\Factories\UserFactory;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class AccountHasPetTest extends ApplicationCase
{
    #[Test]
    public function it_gets_a_pet_for_a_account_given_it_is_approved()
    {
        $account = AccountFactory::new()
            ->for(UserFactory::new())
            ->has(PetFactory::new(['name' => PetName::PET_ZILYANA])->approved())
            ->create();


        $pet = $this->subjectUnderTesting()->accountHasPet($account, PetName::PET_ZILYANA);

        $this->assertModelExists($pet);

        $this->assertTrue($account->getKey() === $pet->account_id);
    }

    public static function shouldNotFindStatuses(): array
    {
        return [
            'Rejected' => [Status::REJECTED],
            'In Process' => [Status::IN_PROCESS],
        ];
    }

    #[Test]
    #[DataProvider('shouldNotFindStatuses')]
    public function it_does_not_get_a_pet_for_a_account_given_it_is_not_approved(Status $status)
    {
        $account = AccountFactory::new()
            ->has(PetFactory::new()->setStatus($status))
            ->create();

        $pet = $this->subjectUnderTesting()->accountHasPet($account, PetName::PET_ZILYANA);

        $this->assertNull($pet);
    }

    protected function subjectUnderTesting(): PetService
    {
        return $this->app->make(PetService::class);
    }
}
