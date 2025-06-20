<?php

namespace Tests\Unit\Wise;

use App\Wise\Client\Exceptions\Configuration\GroupCodeException;
use App\Wise\Client\Exceptions\Configuration\GroupIdException;
use App\Wise\Client\OldMan;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class OldManTest extends ApplicationCase
{
    public static function configProvider()
    {
        return [
            'group code' => ['wise.old-man.group-code', null, GroupCodeException::class],
            'group id' => ['wise.old-man.group-id', null, GroupIdException::class]
        ];
    }


    /**
     * @return void
     */
    #[Test]
    #[DataProvider('configProvider')]
    public function it_throws_configuration_exception_when_config_is_incorrect($key, $value, $class)
    {
        Config::set($key, $value);

        $this->assertThrows(function () {
            App::make(OldMan::class);
        }, $class);
    }

    #[Test]
    public function it_can_instantiate_from_container()
    {
        Http::fake();

        Config::set('wise.old-man.group-id', 2244);
        Config::set('wise.old-man.group-code', 'this-is-the-group-code');
        Config::set('wise.old-man.url', 'https://test-url.com/something-something');

        /** @var OldMan $sut */
        $sut = App::make(OldMan::class);

        $fakedCallUrlSegments = $sut->client()->get('get')->effectiveUri();

        $this->assertEquals(2244, $sut->getGroupId());
        $this->assertEquals('this-is-the-group-code', $sut->getGroupCode());
        $this->assertEquals('https', $fakedCallUrlSegments->getScheme());
        $this->assertEquals('test-url.com', $fakedCallUrlSegments->getHost());
        $this->assertEquals('/something-something/get', $fakedCallUrlSegments->getPath());


    }
}
