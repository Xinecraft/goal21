@component('mail::message')
# Welcome to Goal21 Network, {{ $user->full_name }}!

And thank you for joining our community.

Hopefully you already have an idea on how Goal21 work. If not, no worries we will guide you though the procedure once you login to your account.

Here are your login details. <br>DON'T SHARE YOUR PASSWORD WITH ANYONE!
@component('mail::panel')
    Username: <b>{{ $user->username }}</b><br>
    Password: <b>{{ $password }}</b>
@endcomponent

Lets go,
@component('mail::button', ['url' => route('login'), 'color' => 'success'])
Login & Get Started Now
@endcomponent

Regards,<br>
{{ config('app.name') }} Team
@endcomponent
