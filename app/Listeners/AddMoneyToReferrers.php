<?php

namespace App\Listeners;

use App\Events\NewPremiumSubscription;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddMoneyToReferrers
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewPremiumSubscription  $event
     * @return void
     */
    public function handle(NewPremiumSubscription $event)
    {
        $user = $event->user;

        // Traverse 7 level and give user money as per Chart down to bottom
        // 5
        // 5
        // 10
        // 10
        // 10
        // 20
        // 30

        // Make a copy of User
        $tempUser = $user;
        // Payment Data Creation Iteration Logic for Each User.
        $i = 1;
        do
        {
            // Get Referral User from previous user.
            $referredby = $tempUser->referredby;

            // Calculate Sum based of Level and give amount as stated in his business logic
            if (in_array($i, [1])) $referralMoney = 30;
            else if (in_array($i, [2])) $referralMoney = 20;
            else if (in_array($i, [3,4,5])) $referralMoney = 10;
            else if (in_array($i, [6,7])) $referralMoney = 5;
            else $referralMoney = 0;

            // Add to his main wallet
            $referredby->depositFloat($referralMoney, ['desc' => "New premium user $user->username referral income", 'txn_id' => str_random(16)]);

            // Set temp user to user 1 above for next iteration in tree
            $tempUser = $referredby;
            ++$i;
        }
        while($tempUser->referredby != null && $i <= 7);
    }
}
