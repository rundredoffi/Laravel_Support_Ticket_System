<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\FilterTicketsRequest;
use App\Http\Requests\Ticket\StoreTicketRequest;
use App\Http\Requests\Ticket\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketService;

class TicketController extends Controller
{
    /**
     * Display the page with ticket list.
     *
     * @see \App\View\Composers\CategoryComposer::compose()  Gets categories.
     * @see \App\View\Composers\PriorityComposer::compose()  Gets priorities.
     *
     * @param  \App\Http\Requests\Ticket\FilterTicketsRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(FilterTicketsRequest $request)
    {
        $tickets = (new TicketService())->getTickets($request->validated());

        return view('web.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     *
     * @see \App\View\Composers\CategoryComposer::compose()  Gets categories.
     * @see \App\View\Composers\PriorityComposer::compose()  Gets priorities.
     * @see \App\View\Composers\LabelComposer::compose()  Gets labels.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('web.tickets.create');
    }

    /**
     * Store a newly created ticket.
     *
     * @see \App\Observers\TicketObserver::created()  Sends notifcation to administrators.
     *
     * @param  \App\Http\Requests\Ticket\StoreTicketRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTicketRequest $request)
    {
        /** @var Ticket */
        $ticket = auth()->user()->tickets()
            ->create($request->only(['title', 'description', 'priority_id']));

        $ticket->uploadFiles($request->file('files'));

        $ticket->categories()->attach($request->categories);
        $ticket->labels()->attach($request->labels);

        return redirect()->route('tickets.show', $ticket)
            ->withSuccess($this->successMessage('ticket', 'created'));
    }

    /**
     * Display the specified ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket = $ticket->load(['comments', 'activities']);

        return view('web.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified ticket.
     *
     * @see \App\Models\User::scopeAssignableToTickets()  Gets users that can be assigned to tickets.
     * @see \App\View\Composers\CategoryComposer::compose()  Gets categories.
     * @see \App\View\Composers\PriorityComposer::compose()  Gets priorities.
     * @see \App\View\Composers\LabelComposer::compose()  Gets labels.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $agents = null;

        if (auth()->user()->can('assignAgent', $ticket)) {
            $agents = User::select(['id', 'first_name', 'last_name'])
                ->assignableToTickets()
                ->orderBy('first_name', 'ASC')
                ->get();
        }

        return view('web.tickets.edit', compact('ticket', 'agents'));
    }

    /**
     * Update the specified ticket.
     *
     * @param  \App\Http\Requests\Ticket\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->only(['title', 'description', 'priority_id', 'agent_id']));

        $ticket->categories()->sync($request->categories);
        $ticket->labels()->sync($request->labels);

        return redirect()->route('tickets.show', $ticket)
            ->withSuccess($this->successMessage('ticket', 'updated'));
    }

    /**
     * Remove the specified ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        if (!$ticket->delete()) {
            return redirect()->route('tickets.show', $ticket)
                ->withFail($this->failMessage('ticket', 'deleted'));
        }

        return redirect()->route('tickets.index')
            ->withSuccess($this->successMessage('ticket', 'deleted'));
    }

    /**
     * Close the specified ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function close(Ticket $ticket)
    {
        $this->authorize('close', $ticket);

        $ticket->update(['closed_at' => now()]);

        activity()
            ->useLog('ticket')
            ->performedOn($ticket)
            ->causedBy(auth()->user())
            ->log('The ticket has been closed.');

        return redirect()->route('tickets.show', $ticket)
            ->withSuccess($this->successMessage('ticket', 'closed'));
    }
}
