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

    public function handle(NewMemberAdded $event)
    {
        $user = $event->user;
        $referrer = $user->referredby;

        $nearestEmptyUser = $this->getNearestEmptyNode($referrer);

        // Save Referral
        $user->referral_user_id_autofill = $nearestEmptyUser->id;
        $user->save();

        $nearestEmptyUser->total_referrals_autofill += 1;
        $nearestEmptyUser->save();
    }

    public function getNearestEmptyNode($rootUser)
    {
        // Create a new Queue
        $queue = new \SplQueue();

        // Add the Root to the Queue
        $queue->enqueue($rootUser);

        // While Queue is not Empty
        while (!$queue->isEmpty())
        {
            // Get the Queued User
            $currentUser = $queue->dequeue();
            $currentNode = new \stdClass();
            $currentNode->data = $currentUser;

            // Get the Referrals. ie. Left and Right and Middle
            $currentUserReferrals = $currentUser->referralsauto;
            $currentNode->left = $currentUserReferrals[0] ?? null;
            $currentNode->middle = $currentUserReferrals[1] ?? null;
            $currentNode->right = $currentUserReferrals[2] ?? null;

            // Add to queue if not NULL. else found an Empty Slot. Add there.
            if($currentNode->left)
            {
                $queue->enqueue($currentNode->left);
            }
            else
            {
                return $currentUser;
                break;
            }

            if($currentNode->middle)
            {
                $queue->enqueue($currentNode->middle);
            }
            else
            {
                return $currentUser;
                break;
            }

            if($currentNode->right)
            {
                $queue->enqueue($currentNode->right);
            }
            else
            {
                return $currentUser;
                break;
            }
        }
    }
}
