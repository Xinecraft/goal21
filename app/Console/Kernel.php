<?php

namespace App\Console;

use App\Console\Commands\ProcessWalletOne;
use App\Console\Commands\ProcessWalletThree;
use App\Console\Commands\ProcessWalletTwo;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ProcessWalletOne::class,
        ProcessWalletTwo::class,
        ProcessWalletThree::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Must run first. and daily at 0:0
        $schedule->call(function () {
            DB::table('task_user')->delete();
        })->daily();
        // Must run second. and daily at 0:0
        $schedule->command('process:wallettwo')->monthlyOn(10);
        // Second
        $schedule->command('process:walletthree')->weeklyOn(5);
        // Must run at last
        $schedule->command('process:walletone')->daily();
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
