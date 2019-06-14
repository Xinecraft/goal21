<?php

namespace App\Listeners;

use App\Events\NewMemberAdded;
use App\Mail\MemberWelcomeMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
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
        $password = $event->password;
        // Send the mail
        Mail::to($user)->send(new MemberWelcomeMail($user, $password));
    }
}
