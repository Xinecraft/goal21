@component('mail::message')
# <span style="color:#41e216">Yey, Payment Verified!</span>
## Receiver has verified that he received the payment.

Your payment transaction of <b>{{ $payment->payment_amount }} INR</b> to <b>{{ $payment->receiver->full_name }}</b> is verified by the receiver.
Login to your profile to know more.

@component('mail::button', ['url' => route('get.paytodata')])
View Payments
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
