<?php

namespace Tests\Unit\Wise;

trait HasFixtureAccess
{
    public function getFromFixture(string $filename): false|string
    {
        return file_get_contents(base_path("Tests/fixtures/$filename"));
    }
}
