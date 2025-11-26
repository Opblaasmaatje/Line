<?php

namespace Tests\Unit\Laracord\ModuleLoader;

use App\Laracord\ModuleLoader\Loader;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class LoaderTest extends ApplicationCase
{
    #[Test]
    public function it_can_get_active()
    {
        Config::set('app.modules.active', ['core']);

        $array = $this->subjectUnderTesting()->getActive()->toArray();

        $this->assertMatchesJsonSnapshot(json_encode($array));
    }

    #[Test]
    public function it_can_get_commands()
    {
        Config::set('app.modules.active', ['core', 'pets']);

        $array = $this->subjectUnderTesting()->getActiveCommands()->toArray();

        $this->assertMatchesJsonSnapshot(json_encode($array));
    }

    protected function subjectUnderTesting(): Loader
    {
        return $this->app->make(Loader::class);
    }
}
