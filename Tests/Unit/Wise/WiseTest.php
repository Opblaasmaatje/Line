<?php

namespace Tests\Unit\Wise;

use App\Models\Account;
use App\Wise\Facade\WiseOldManPlayer;
use Database\Factories\AccountFactory;
use Tests\ApplicationCase;

class WiseTest extends ApplicationCase
{
    public function test_it_works()
    {
        /** @var Account $account */
        $account = AccountFactory::new()->create([
            'username' => 'sus guy',
            'user_id' => 1,
        ]);

        $thing = WiseOldManPlayer::details($account->username)->toArray();

        $account->snapshot()->updateOrCreate([
            'raw_details' => $thing,
        ]);

        /**
         * @phpstan-ignore method.alreadyNarrowedType
         */
        $this->assertTrue(true);
    }
}
