<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\GoogleFetchCommand;
use App\Console\Commands\SyncGoogleSheetCommand;
use App\Services\GoogleSheetsService;
use Google_Client;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withCommands([
        GoogleFetchCommand::class,
        SyncGoogleSheetCommand::class,
    ])
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->command('google:sync')->everyMinute();
    })
    ->withSingletons([
        GoogleSheetsService::class => fn (Application $app): GoogleSheetsService => new GoogleSheetsService(
            $app,
            new Google_Client()
        ),
    ])
    ->create();
