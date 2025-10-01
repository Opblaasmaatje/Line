<?php

namespace Tests\Unit\Wise\Helpers;

use App\Wise\Helpers\WiseOldManUrl;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class WiseOldManUrlTest extends ApplicationCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Config::set('wise-old-man.url', 'https://the-config-value.com/');
    }

    #[Test]
    public function it_can_get_a_player_url()
    {

        $string = WiseOldManUrl::forPlayer('some-user-name');

        $this->assertStringContainsString(
            'https://the-config-value.com/players/some-user-name',
            $string,
        );
    }

    #[Test]
    public function it_can_get_a_competition()
    {
        $string = WiseOldManUrl::forCompetition('some-competition-title');

        $this->assertStringContainsString(
            'https://the-config-value.com/competitions/some-competition-title',
            $string,
        );
    }
}
