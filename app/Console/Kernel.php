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

        $schedule->command('process:walletone')->daily();
        $schedule->command('process:walletthree')->weeklyOn(5, '6:00');
        $schedule->command('process:wallettwo')->monthlyOn(1, '0:59');

        $schedule->command('telescope:prune --hours=48')->daily();
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
