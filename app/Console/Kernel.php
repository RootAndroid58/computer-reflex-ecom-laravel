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
        'App\Console\Commands\CreditAffiliateComission',
        'App\Console\Commands\ShippingStatusUpdate',
        'App\Console\Commands\SendProductLicenseKeys',
        'App\Console\Commands\RemoveAffiliates',
        'App\Console\Commands\EmailParse',
    ];


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('command:CreditAffiliateComission')->daily();
        $schedule->command('command:ShippingStatusUpdate')->everyMinute();
        $schedule->command('command:SendProductLicenseKeys')->everyMinute();
        $schedule->command('command:RemoveAffiliates')->everySixHours();
        // $schedule->command('command:CronTest')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
