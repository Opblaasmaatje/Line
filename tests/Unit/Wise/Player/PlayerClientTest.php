<?php

namespace Tests\Unit\Wise\Player;

use App\Wise\Client\Endpoints\Players\PlayerEndpoint;
use App\Wise\Client\Exceptions\CommunicationException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class PlayerClientTest extends ApplicationCase
{
    use HasFixtureAccess;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('wise-old-man.group-code', 'group-code');
        Config::set('wise-old-man.group-id', 111);
    }

    #[Test]
    public function it_creates_an_api_call()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response($this->getFromFixture('snapshot_details.json'), 200),
        ]);

        /** @var PlayerEndpoint $client */
        $client = App::make(PlayerEndpoint::class);

        $client->details('sus_guy');

        Http::assertSent(function (Request $request) {
            return 'https://api.wiseoldman.net/v2/players/sus_guy' === $request->url();
        });
    }

    #[Test]
    public function it_returns_false_when_user_is_not_found()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response(null, 404),
        ]);

        /** @var PlayerEndpoint $client */
        $client = App::make(PlayerEndpoint::class);

        $this->assertFalse($client->details('sus_guy'));
    }
}
