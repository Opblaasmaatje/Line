<?php

namespace Tests\Unit\Modules\Points\Configuration;

use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Bosses\Boss;
use App\Wise\Client\Endpoints\Players\DTO\Snapshot\Skills\Skill;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Tests\ApplicationCase;

class PointConfigTest extends ApplicationCase
{
    #[Test]
    public function bosses_key_is_set()
    {
        $configuration = Config::get('points.bosses.'.Boss::class);

        $this->assertIsArray($configuration);

        $this->assertIsInt(Arr::get($configuration, 'per'));
        $this->assertIsFloat(Arr::get($configuration, 'give'));
    }

    #[Test]
    public function skills_key_is_set()
    {
        $configuration = Config::get('points.skills.'.Skill::class);

        $this->assertIsArray($configuration);

        $this->assertIsInt(Arr::get($configuration, 'per'));
        $this->assertIsFloat(Arr::get($configuration, 'give'));
    }
}
