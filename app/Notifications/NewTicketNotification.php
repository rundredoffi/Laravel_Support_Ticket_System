<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTicketNotification extends Notification
{
    use Queueable;

    /**
     * @var int
     */
    protected $ticketId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($ticketId)
    {
        $this->ticketId = $ticketId;
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
            ->subject(__('Nouveau ticket') . ' - ' . config('app.name', 'TrackIT Support System'))
            ->greeting(__('Bonjour ' . $notifiable->first_name . ','))
            ->line(__('Un nouveau ticket a été soumis.'))
            ->action(__('Voir le ticket'), route('tickets.show', $this->ticketId))
            ->line(__('Assurez-vous d\'assigner un agent au ticket.'));
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
