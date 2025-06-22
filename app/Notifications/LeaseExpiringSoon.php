<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class LeaseExpiringSoon extends Notification
{
    use Queueable;

    /**
     * @param Collection<int, \App\Models\Lease> $leases
     */
    public function __construct(public Collection $leases)
    {
    }

    /**
     * Kanały dostarczania powiadomienia.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Utwórz wiadomość e-mail.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Umowy wygasające w ciągu 30 dni')
            ->line('Poniżej lista umów wygasających w ciągu 30 dni:');

        foreach ($this->leases as $lease) {
            $message->line(
                $lease->unit->property->name.' / '.$lease->unit->name.' - '.
                $lease->tenant->first_name.' '.$lease->tenant->last_name.
                ' (do '.$lease->end_date.')'
            );
        }

        $message->line('Zaloguj się do panelu, aby uzyskać więcej informacji.');

        return $message;
    }
}
