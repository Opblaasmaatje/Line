<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

abstract class ApplicationCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function getRequest(array $data): Request
    {
        $request = new Request(content: json_encode($data));

        App::instance('request', $request);

        return $request;
    }
}
