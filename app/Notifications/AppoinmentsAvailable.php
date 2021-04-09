<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class AppoinmentsAvailable extends Notification
{
    use Queueable;


    public function __construct(public Collection $sites)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable): MailMessage
    {
        $message =  (new MailMessage)
                    ->subject('Vaccine Appointment Available')
                    ->line('Appointments are available!.');

        foreach($this->sites as $site) {
            $string = "<a href='$site->url' target='_blank'>$site->name</a>";
            $message->line(new HtmlString($string));
            $message->line($site->address . ', ' . $site->city . ',' . $site->state);
            $message->line('');
        }
        $message->line('');
        $message->line('Your notification will need to be created again if you wish to receive more notifications.');
        $message->action('Visit Vaccine Notifier', url('/'));
        return $message;

    }


}
