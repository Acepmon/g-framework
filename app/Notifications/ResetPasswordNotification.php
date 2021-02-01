<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Request;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $url = url('/password/reset/' . $this->token . '?email=' . $notifiable->email);
        return (new MailMessage)
                    ->subject('MAZ Нууц үг сэргээх')
                    ->line('Та өөрийн maz хэрэглэгчийн нууц үгээ сэргээх хүсэлт явуулсан байна.')
                    ->action('Нууц үг сэргээх', $url)
                    ->line('Энэхүү линк нь 60 минутын дотор идэвхитэй.')
                    ->line('Хэрвээ та нууц үг сэргээх хүсэлт илгээгээгүй бол дээрх товчин дээр дарах хэрэггүй.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $url = url('/password/reset/' . $this->token . '?email=' . $notifiable->email);

        return [
            'title' => 'You have requested a password reset for your account.',
            'body' => 'This password reset link will expire in 60 minutes',
            'link' => $url,
            'thumbnail' => url(asset('placeholder.jpg'))
        ];
    }
}
