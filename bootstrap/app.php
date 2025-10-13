<?php

use BeyondCode\ErdGenerator\GenerateDiagramCommand;
use Illuminate\Cache\Console\ClearCommand;
use Illuminate\Foundation\Console\ConfigClearCommand;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Foundation\Console\VendorPublishCommand;
use LaravelZero\Framework\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withCommands([
        StorageLinkCommand::class,
        GenerateDiagramCommand::class,
        VendorPublishCommand::class,
        ConfigClearCommand::class,
        ClearCommand::class,
    ])
    ->create();
