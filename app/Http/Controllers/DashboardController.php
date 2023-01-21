<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page with statistics.
     *
     * @see \App\Models\Ticket::scopeOpen()  Gets only open tickets.
     * @see \App\Models\Ticket::scopeClosed()  Gets only closed tickets.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke()
    {
        $this->authorize('access-dashboard');

        $totalTickets = Ticket::count();
        $openTickets = Ticket::open()->count();
        $closedTickets = Ticket::closed()->count();

        return view('web.dashboard', compact('totalTickets', 'openTickets', 'closedTickets'));
    }
}
