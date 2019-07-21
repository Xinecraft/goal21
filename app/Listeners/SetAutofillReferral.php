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
                // Keep trying can be false
                $keeptrying = false;
                break;
            }
            else {
                // Go one level down the line
                $referrer = $referrer->referralsauto->first();
                $keeptrying = true;
            }
        }
    }
}
