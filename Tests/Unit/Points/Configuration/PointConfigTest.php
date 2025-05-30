<?php

namespace Tests\Unit\Points\Configuration;

use App\Wise\Client\Players\Objects\Snapshot\Bosses\Boss;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class PointConfigTest extends ApplicationCase
{
    #[Test]
    public function boss_key_is_set()
    {
        $configuration = Config::get('points.bosses.' . Boss::class);

        $this->assertIsArray($configuration);

        $this->assertIsInt(Arr::get($configuration, 'give'));
        $this->assertIsInt(Arr::get($configuration, 'per'));

    }
}
