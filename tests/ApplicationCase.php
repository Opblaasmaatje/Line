<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Snapshots\MatchesSnapshots;

abstract class ApplicationCase extends BaseTestCase
{
    use RefreshDatabase;
    use MatchesSnapshots;

    protected function getRequest(array $data): Request
    {
        $request = new Request(content: json_encode($data));

        App::instance('request', $request);

        return $request;
    }
}
