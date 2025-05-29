<?php

namespace Tests\Unit\Wise;

use App\Models\Account;
use Database\Factories\AccountFactory;
use Tests\ApplicationCase;

class WiseTest extends ApplicationCase
{
    public function test_it_works()
    {
        /** @var Account $account */
        $account = AccountFactory::new()->create([
            'username' => 'sus guy',
            'user_id' => 1
        ]);

        $this->assertTrue(true);
    }
}
