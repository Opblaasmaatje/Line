<?php

use Illuminate\Cache\Console\ClearCommand;
use Illuminate\Foundation\Console\ConfigClearCommand;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Foundation\Console\VendorPublishCommand;
use LaravelZero\Framework\Application;
use Recca0120\LaravelErd\Console\Commands\GenerateErd;

return Application::configure(basePath: dirname(__DIR__))
    ->withCommands([
        StorageLinkCommand::class,
        VendorPublishCommand::class,
        ConfigClearCommand::class,
        ClearCommand::class,
        GenerateErd::class,
    ])
    ->create();
