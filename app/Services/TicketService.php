<?php

namespace App\Services;

use App\Models\Ticket;

class TicketService
{
    /**
     * Get filtered tickets accessible by the authenticated user.
     *
     * @see \App\Models\Ticket::scopeAccessible()  Gets only tickets that are accessible by the user.
     * @see \App\Models\Ticket::scopeOpen()  Gets only open tickets.
     * @see \App\Models\Ticket::scopeClosed()  Gets only closed tickets.
     *
     * @param  array|null  $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getTickets($filters = null)
    {
        $tickets = Ticket::query()
            ->select(['id', 'updated_at', 'title', 'priority_id', 'agent_id', 'closed_at'])
            ->with(['priority', 'agent'])
            ->accessible();

        if (!empty($filters['status'])) {
            if ($filters['status'] === 'open') {
                $tickets->open();
            } else {
                $tickets->closed();
            }
        }

        if (!empty($filters['priority'])) {
            $tickets->where('priority_id', $filters['priority']);
        }

        if (!empty($filters['category'])) {
            $tickets->whereRelation('categories', 'id', $filters['category']);
        }

        return $tickets->latest('updated_at')
            ->paginate(20)
            ->appends($filters ?? '');
    }
}
