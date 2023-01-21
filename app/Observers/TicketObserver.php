<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Support\Facades\Notification;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return void
     */
    public function created(Ticket $ticket)
    {
        // Send notification to admins.
        Notification::send(User::administrators()->get(), new NewTicketNotification($ticket->id));
    }
}
