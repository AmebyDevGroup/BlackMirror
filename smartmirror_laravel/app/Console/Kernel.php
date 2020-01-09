<?php

namespace App\Console;

use App\Console\Commands\SendAirQuality;
use App\Console\Commands\SendCalendar;
use App\Console\Commands\SendNews;
use App\Console\Commands\SendTasks;
use App\Console\Commands\SendWeather;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendTasks::class,
        SendCalendar::class,
        SendNews::class,
        SendWeather::class,
        SendAirQuality::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('ws:tasks')
                    ->everyMinute()
                    ->runInBackground();
        $schedule->command('ws:calendar')
                    ->everyFifteenMinutes()
                    ->runInBackground();
        $schedule->command('ws:news')
                    ->hourly()
                    ->runInBackground();
        $schedule->command('ws:weather')
                    ->hourly()
                    ->runInBackground();
        $schedule->command('ws:airquality')
                    ->everyThirtyMinutes()
                    ->runInBackground();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
