<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ShootingNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name, $email, $phone, $city, $place, $event, $date)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->city = $city;
        $this->place = $place;
        $this->event = $event;
        $this->date = $date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Здраво!')
                    ->line('Стигао вам је нов захтев за фотографисање.')
                    ->line('Кориснике је унео следеће податке:')
                    ->line('Име: '.$this->name)
                    ->line('Име: '.$this->email)
                    ->line('Име: '.$this->phone)
                    ->line('Име: '.$this->city)
                    ->line('Име: '.$this->place)
                    ->line('Име: '.$this->event)
                    ->line('Име: '.$this->date)
                    ->action('Проверите све захтеве на линку', url('/admin-area/shootings'))
                    ->line('Одговорите кориснику на захтев путем е-маила.');
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
            //
        ];
    }
}
