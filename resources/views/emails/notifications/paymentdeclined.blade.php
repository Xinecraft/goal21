@component('mail::message')
# <span style="color:#f14008">Whoops, Payment Declined!</span>
## Receiver not got the money on your specified method.

Your payment transaction of <b>{{ $payment->payment_amount }} INR</b> to <b>{{ $payment->receiver->full_name }}</b> is declined by the receiver.
Please login and verify your transaction and retry. Raise a ticket from panel if any issue.

@component('mail::button', ['url' => route('get.paytodata')])
Review Payment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
