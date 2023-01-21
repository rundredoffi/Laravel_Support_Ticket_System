<?php

namespace App\Policies\Ticket;

use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create ticket comments.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Ticket $ticket)
    {
        return !$ticket->isClosed()
            && ($user->id === $ticket->user_id || $user->canDealWithTickets());
    }

    /**
     * Determine whether the user can update the ticket comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TicketComment  $ticketComment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, TicketComment $comment)
    {
        return !$comment->ticket->isClosed() && $user->id === $comment->user_id;
    }

    /**
     * Determine whether the user can delete the ticket comment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TicketComment  $comment
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, TicketComment $comment)
    {
        return !$comment->ticket->isClosed()
            && $user->id === $comment->user_id
            && $user->canDealWithTickets();
    }
}
