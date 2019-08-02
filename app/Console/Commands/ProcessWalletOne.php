<?php

namespace App\Console\Commands;

use App\Task;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ProcessWalletOne extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:walletone';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will clear or move wallet one of user as per conditions';

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
        $tasksCount = Task::where('is_active', 1)->count();
        $users = User::all();

        foreach ($users as $user) {
            Log::info("=====SELF EARNING=====");
            // If he has not completed all his task then flush his Day Earning.
            if ($user->total_task_pending > 0) {
                Log::info($user->username . " has not completed tasks. WalletOne: 0");
                $user->wallet_one = 0;
            } // If he has completed his tasks so move day earning to month earning
            else {
                // Move his wallet one to wallet two
                Log::info($user->username . " has completed tasks. Moving INR " . $user->wallet_one . " to WalletTwo.");
                $user->wallet_two += $user->wallet_one;
                $user->wallet_one = 0;


                Log::info("=====MATRIX EARNING=====");
                /**
                 * Lets add money to his Matrix referrers too. Upto 7 levels
                 */
                // Make a copy of User
                $tempUser = $user;
                // Task Payment Data Creation Iteration Logic for Each User.
                $i = 1;
                while ($tempUser->referredby != null && $i <= 7) {
                    // Get Referral User from previous user.
                    $referredby = $tempUser->referredby;

                    // Calculate Sum based of Level and give amount as stated in his business logic
                    if (in_array($i, [1])) $referralMoney = 1.5;
                    else if (in_array($i, [2])) $referralMoney = 1;
                    else if (in_array($i, [3])) $referralMoney = 0.75;
                    else if (in_array($i, [4])) $referralMoney = 0.5;
                    else if (in_array($i, [5, 6, 7])) $referralMoney = 0.3;
                    else $referralMoney = 0;

                    // Add to his second wallet
                    if ($referredby->total_task_pending > 0) {
                        Log::info("$referredby->username get INR 0 for $user->username Task in Matrix. Reason: Self task not done");
                    } else {
                        Log::info("$referredby->username get INR $referralMoney for $user->username Task in Matrix");
                        $referredby->wallet_two += $referralMoney;
                    }
                    $referredby->save();

                    // Set temp user to user 1 above for next iteration in tree
                    $tempUser = $referredby;
                    ++$i;
                }

                Log::info("=====AUTOFILL EARNING=====");
                /**
                 * If user is premium then lets add money to his autofill referrers too. Upto 10 Levels
                 */
                // Make a copy of User
                $tempUser = $user;
                // Task Payment Data Creation Iteration Logic for Each User.
                $i = 1;
                while ($tempUser->referredbyauto != null && $i <= 10){
                    // Get Referral User from previous user.
                    $referredbyauto = $tempUser->referredbyauto;

                    // Calculate Sum based of Level and give amount as stated in his business logic
                    $referralMoney = 0.50;

                    // Add to his second wallet
                    if ($referredbyauto->total_task_pending > 0 || $referredbyauto->payment_confirmed <= 0) {
                        Log::info("$referredbyauto->username get INR 0 for $user->username Task in Autofill. Reason: Self task not done/Not Premium");
                    } else {
                        Log::info("$referredbyauto->username get INR $referralMoney for $user->username Task in Autofill");
                        $referredbyauto->wallet_two += $referralMoney;
                    }
                    $referredbyauto->save();

                    // Set temp user to user 1 above for next iteration in tree
                    $tempUser = $referredbyauto;
                    ++$i;
                }
            }
            $user->wallet_two = round($user->wallet_two, 2);
            $user->total_task_pending = $tasksCount;
            $user->save();
        }
        Log::info("WalletOne Cron Successful");
        $this->info('ProcessWalletOne ran successfully');
    }
}
