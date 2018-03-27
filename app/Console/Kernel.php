<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Artisan;

class Kernel extends ConsoleKernel
{
    /**
     * Use this to import third-party commands.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->command('import:all --quiet')
            ->dailyAt('02:' .(config('app.env') == 'production' ? '00' : '15'))
            ->withoutOverlapping()
            ->before(function () {
                Artisan::call('download', ['--quiet' => 'default']);
            })
            ->appendOutputTo(storage_path('logs/import.log'))
            ->sendOutputTo(storage_path('logs/import-last-run.log'))
            ->emailOutputTo([env('LOG_EMAIL_1'), env('LOG_EMAIL_2')], true);

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
