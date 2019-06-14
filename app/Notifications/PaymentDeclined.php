<?php

namespace App\Notifications;

use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentDeclined extends Notification
{
    use Queueable;
    /**
     * @var Payment
     */
    private $payment;

    /**
     * Create a new notification instance.
     *
     * @param Payment $payment
     */
    public function __construct(Payment $payment)
    {
        //
        $this->payment = $payment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('emails.notifications.paymentdeclined',['payment' => $this->payment])
            ->subject('Payment to '.$this->payment->receiver->full_name.' is Rejected');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'payment_id' => $this->payment->id,
            'payment_amount' => $this->payment->payment_amount,
            'payment_receiver_name' => $this->payment->receiver->full_name,
            'payment_receiver_username' => $this->payment->receiver->username,
        ];
    }
}
