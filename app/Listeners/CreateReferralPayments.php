<?php

namespace App\Listeners;

use App\Events\NewMemberAdded;
use App\Payment;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

// @TODO: REMOVE IT UNUSED!
class CreateReferralPayments
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

        // Calculate Amount to Company and subtract that from Total Sharable Amount
        $toCompanyAmount = round((7.41 / 100) * $user->payment_amount);
        $shareableAmount = $user->payment_amount - $toCompanyAmount;
        $remainingShareAmount = $shareableAmount;

        // Make a copy of User
        $tempUser = $user;
        // Payment Data Creation Iteration Logic for Each User.
        $i = 1;
        do
        {
            // Get Referral User from previous user.
            $referredby = $tempUser->referredby;

            // Calculate Sum based of UserLevel and give 15% or 20%
            if($i <= 1)
            {
                $paymentUserAmount = round((25 / 100) * $shareableAmount);
                $remainingShareAmount = $remainingShareAmount - $paymentUserAmount;
            }
            else
            {
                $paymentUserAmount = round((15 / 100) * $shareableAmount);
                $remainingShareAmount = $remainingShareAmount - $paymentUserAmount;
            }

            // TODO CHECK: If User is banned then add the money to company account and don't create payment for this user.
            if($referredby->is_banned)
            {
                $toCompanyAmount = $toCompanyAmount + $paymentUserAmount;
            }
            else
            {
                // Create Payment Data
                $createArray = [
                    'uuid' => \Uuid::generate(4),
                    'sender_id' => $user->id,
                    'receiver_id' => $referredby->id,
                    'payment_method' => $referredby->preferred_payment_method,
                    'payment_data' => $referredby->paytextdata,
                    'payment_amount' => $paymentUserAmount
                ];
                Payment::create($createArray);
            }

            // Set temp user to user 1 above for next iteration in tree
            $tempUser = $referredby;
            ++$i;
        }
        while($tempUser->referredby != null && $i <= 6);


        // Add Money Data to be Sent to Company
        $companyUser = User::findorFail(1);
        $toCompanyTotalAmount = $remainingShareAmount + $toCompanyAmount;
        $createArray = [
            'uuid' => \Uuid::generate(4),
            'sender_id' => $user->id,
            'receiver_id' => $companyUser->id,
            'payment_method' => $companyUser->preferred_payment_method,
            'payment_data' => $companyUser->paytextdata,
            'payment_amount' => $toCompanyTotalAmount
        ];
        Payment::create($createArray);
    }
}
