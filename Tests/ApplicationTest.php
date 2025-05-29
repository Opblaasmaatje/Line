<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class ApplicationTest extends BaseTestCase
{
    use RefreshDatabase;
}

