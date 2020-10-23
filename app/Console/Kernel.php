<?php

namespace App\Console;

Use Statamic\Facades\Entry;

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

        // Purge Secret Santa submissions. 
        $schedule->call( function() {

            // find secrect santa collection 
            $entries = Entry::whereCollection('secret_santa_submissions');
            // loop and remove.
            collect($entries)->each( function($item, $key) {
                try {
                    $item->delete();
                } catch(\Exception $e) {
                   
                    return $e;
                }
            });

        })->cron('1 0 24 12 *');
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
