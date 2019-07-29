<?php

namespace App\Console\Commands;

use App\Task;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessWalletTwo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:wallettwo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will move all user wwallet two money into wallet three';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::all();
        foreach ($users as $user)
        {
            Log::info("Task Earning INR $user->wallet_two of $user->username is moved to Final Wallet");
            $user->depositFloat(round($user->wallet_two,2), ['desc' => 'Monthly revenue', 'txn_id' => str_random(16)]);
            $user->wallet_two = 0;
            $user->save();
        }
        Log::info("WalletTwo Cron Successful");
        $this->info('ProcessWalletTwo ran successfully');
    }
}
