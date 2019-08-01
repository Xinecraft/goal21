<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessWalletThree extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:walletthree';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Wallet Three';

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
            // User premium move his Referral Earning to Final
            if($user->payment_confirmed >= 1)
            {
                Log::info("Referral Earning INR $user->wallet_three of $user->username is moved to Final Wallet");
                if ($user->wallet_three > 0)
                {
                    $user->depositFloat(round($user->wallet_three,2), ['desc' => 'Weekly Referral Earning', 'txn_id' => str_random(16)]);
                    $user->wallet_three = 0;
                    $user->save();
                }
            }
            else
            {
                $user->wallet_three = 0;
                $user->save();
            }
        }
        Log::info("WalletThree Cron Successful");
        $this->info('ProcessWalletThree ran successfully');
    }
}
