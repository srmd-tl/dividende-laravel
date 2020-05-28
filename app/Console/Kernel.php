<?php

namespace App\Console;

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
        Commands\FetchFundamental::class,
        Commands\RemoveDuplicates::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fetch:fundamental')
        // ->everyMinute();
            ->daily();
        $schedule->command('remove:dups')
            ->everyMinute();

        // ->dailyAt('13:00');//1 am
        // ->dailyAt('14:00');//2 pm
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

// * * * * *  php /home/u748339178/domains/dividende.co/public_html/dividende-laravel/artisan schedule:run >> /dev/null 2>&1

// * * * * *  php /home/sarmad/Work/FreelanceWork/PhpProjects/dividende/artisan schedule:run >> /dev/null 2>&1
