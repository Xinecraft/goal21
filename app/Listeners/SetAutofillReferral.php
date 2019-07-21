<?php

namespace App\Listeners;

use App\Events\NewMemberAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetAutofillReferral
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
     * @TODO: Remove this shit algo and add ssome kind of Balanced Ternary Tree Addition Algorithm
     *
     * @param  NewMemberAdded  $event
     * @return void
     */
    public function handle(NewMemberAdded $event)
    {
        $user = $event->user;
        $referrer = $user->referredby;

        $keeptrying = true;
        while ($keeptrying)
        {
            if ($referrer->referralsauto->count() < 3) {
                // User can become his autofill referral
                $user->referral_user_id_autofill = $referrer->id;
                $user->save();

                $referrer->total_referrals_autofill += 1;
                $referrer->save();

                // Keep trying can be false
                $keeptrying = false;
                break;
            }
            else {
                // Check all 3 below users and if anyone have free then select it
                foreach ($referrer->referralauto as $rfo) {
                    if($rfo->referralsauto->count() < 3)
                    {
                        $referrer = $rfo;
                        $keeptrying = true;
                        continue;
                    }
                }

                // All the three Nodes are full. Go one down the first element.
                $referrer = $referrer->referralsauto->first();
                $keeptrying = true;
            }
        }
    }
}
