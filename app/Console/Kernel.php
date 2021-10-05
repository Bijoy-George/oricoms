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
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call('App\Http\Controllers\CronController@group_customer_batch_import')->everyMinute();
        $schedule->call('App\Http\Controllers\CronController@process_campaign_email_batches')->everyMinute();
        //$schedule->call('App\Http\Controllers\CronController@send_email')->everyMinute();

        $schedule->call('App\Http\Controllers\CronController@process_campaign_sms_batches')->everyMinute();
       // $schedule->call('App\Http\Controllers\CronController@send_sms')->everyMinute();

        
       // $schedule->call('App\Http\Controllers\CronController@send_test_email')->everyMinute();
      //  $schedule->call('App\Http\Controllers\CronController@sending_feedback_notification')->everyMinute();
       // $schedule->call('App\Http\Controllers\CronController@expiration_status_updation')->everyMinute();
        $schedule->call('App\Http\Controllers\CronController@reassign_campaign_contacts')->everyMinute();

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
