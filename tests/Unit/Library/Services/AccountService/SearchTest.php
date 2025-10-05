<?php

namespace Tests\Unit\Library\Services\AccountService;

use App\Library\Services\AccountService;
use App\Wise\Client\Endpoints\Players\DTO\Player;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class SearchTest extends ApplicationCase
{
    use HasFixtureAccess;

    #[Test]
    public function it_can_search_players()
    {
        Http::fake([
            '*' => Http::response($this->getFromFixture('search_player.json'))
        ]);

        /** @var Player $object */
        $object = $this->subjectUnderTesting()->search('foo')->first();

        $this->assertEquals('1858515', $object->id);
        $this->assertEquals('zezimmour', $object->username);
    }

    protected function subjectUnderTesting(): AccountService
    {
        return $this->app->make(AccountService::class);
    }
}
