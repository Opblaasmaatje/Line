<?php

namespace Tests\Unit\Wise\Player;

use App\Wise\Client\Players\PlayerClient;
use App\Wise\Client\Players\WiseOldManException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;
use Tests\Unit\Wise\HasFixtureAccess;

class PlayerClientTest extends ApplicationCase
{
    use HasFixtureAccess;

    #[Test]
    public function it_creates_an_api_call()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response($this->getFromFixture('snapshot_details.json'), 200),
        ]);

        /** @var PlayerClient $client */
        $client = App::make(PlayerClient::class);

        $client->details('sus_guy');

        Http::assertSent(function (Request $request){
            return 'https://api.wiseoldman.net/v2/players/sus_guy' === $request->url();
        });
    }

    #[Test]
    public function it_throws_an_exception_when_the_player_id_is_missing()
    {
        Http::fake([
            'api.wiseoldman.net/*' => Http::response(null, 404),
        ]);

        /** @var PlayerClient $client */
        $client = App::make(PlayerClient::class);

        $this->assertThrows(function () use ($client){
            $client->details('sus_guy');

        }, WiseOldManException::class);

    }
}
