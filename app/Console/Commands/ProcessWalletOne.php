<?php

namespace App\Console\Commands;

use App\Task;
use App\User;
use Illuminate\Console\Command;

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

        foreach ($users as $user)
        {
            // If he has not completed all his task then flush his Day Earning.
            if ($user->total_task_pending > 0) {
                $user->wallet_one = 0;
            }
            // If he has completed his tasks so move day earning to month earning
            else {
                // Move his wallet one to wallet two
                $user->wallet_two += $user->wallet_one;
                $user->wallet_one = 0;

                /**
                 * Lets add money to his Matrix referrers too. Upto 7 levels
                 */
                // Make a copy of User
                $tempUser = $user;
                // Task Payment Data Creation Iteration Logic for Each User.
                $i = 1;
                do
                {
                    // Get Referral User from previous user.
                    $referredby = $tempUser->referredby;

                    // Calculate Sum based of Level and give amount as stated in his business logic
                    if (in_array($i, [1])) $referralMoney = 1.5;
                    else if (in_array($i, [2])) $referralMoney = 1;
                    else if (in_array($i, [3])) $referralMoney = 0.75;
                    else if (in_array($i, [4])) $referralMoney = 0.5;
                    else if (in_array($i, [5,6,7])) $referralMoney = 0.3;
                    else $referralMoney = 0;

                    // Add to his second wallet
                    $referredby->wallet_two += $referralMoney;

                    // Set temp user to user 1 above for next iteration in tree
                    $tempUser = $referredby;
                    ++$i;
                }
                while($tempUser->referredby != null && $i <= 7);

                /**
                 * If user is premium then lets add money to his autofill referrers too. Upto 10 Levels
                 */
                if ($user->payment_confirmed > 0)
                {
                    // Make a copy of User
                    $tempUser = $user;
                    // Task Payment Data Creation Iteration Logic for Each User.
                    $i = 1;
                    do
                    {
                        // Get Referral User from previous user.
                        $referredbyauto = $tempUser->referredbyauto;

                        // Calculate Sum based of Level and give amount as stated in his business logic
                        $referralMoney = 0.50;

                        // Add to his second wallet
                        $referredbyauto->wallet_two += $referralMoney;

                        // Set temp user to user 1 above for next iteration in tree
                        $tempUser = $referredbyauto;
                        ++$i;
                    }
                    while($tempUser->referredbyauto != null && $i <= 10);
                }
            }
            $user->wallet_two = round($user->wallet_two, 2);
            $user->total_task_pending = $tasksCount;
            $user->save();
        }
        $this->info('ProcessWalletOne ran successfully');
    }
}
