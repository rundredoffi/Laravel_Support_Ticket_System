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
            ->subject(__('New Ticket') . ' - ' . config('app.name', 'Laravel Support Ticket System'))
            ->greeting(__('Hello ' . $notifiable->first_name . ','))
            ->line(__('A new ticket has been submitted.'))
            ->action(__('Go to the ticket'), route('tickets.show', $this->ticketId))
            ->line(__('Make sure to assign an agent to it.'));
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
