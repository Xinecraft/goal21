@component('mail::message')
# <span style="color:#4ac0f4">Hey, You received a payment & is pending verification!</span>

<b>{{ $payment->sender->full_name }}</b> has stated that he/she has successfully sent you payment of <b>{{ $payment->payment_amount }} INR</b> through {{ $payment->payment_method }}.
<br>
Login to your profile and verify the payment.

@component('mail::button', ['url' => route('get.recvpayments')])
Login & Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
