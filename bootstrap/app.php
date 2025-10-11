<?php

use BeyondCode\ErdGenerator\GenerateDiagramCommand;
use Illuminate\Foundation\Console\StorageLinkCommand;
use LaravelZero\Framework\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withCommands([
        StorageLinkCommand::class,
        GenerateDiagramCommand::class,
    ])
    ->create();
