<?php

namespace App\Console;

use App\Console\Commands\SendAirQuality;
use App\Console\Commands\SendCalendar;
use App\Console\Commands\SendNews;
use App\Console\Commands\SendTasks;
use App\Console\Commands\SendWeather;
use App\Console\Commands\SendCovid;
use App\MirrorConfig;
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
        SendAirQuality::class,
        SendCovid::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $config = MirrorConfig::all();
        foreach ($config as $item) {
             if($item->active) {
                switch ($item->name) {
                    case "air":
                        $schedule->command('ws:airquality')
                            ->everyThirtyMinutes()
                            ->runInBackground();
                        break;
                    case "calendar":
                        $schedule->command('ws:calendar')
                            ->everyFifteenMinutes()
                            ->runInBackground();
                        break;
                    case "news":
                        $schedule->command('ws:news')
                            ->hourly()
                            ->runInBackground();
                        break;
                    case "tasks":
                        $schedule->command('ws:tasks')
                            ->everyMinute()
                            ->runInBackground();
                        break;
                    case "weather":
                        $schedule->command('ws:weather')
                            ->hourly()
                            ->runInBackground();
                        break;
                    case "covid":
                        $schedule->command('ws:covid')
                            ->everyThirtyMinutes()
                            ->runInBackground();
                        break;
                }
             }
        }
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
