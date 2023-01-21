<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\TicketCommentRequest;
use App\Models\Ticket;
use App\Models\TicketComment;

class TicketCommentController extends Controller
{
    /**
     * Store a newly created ticket comment.
     *
     * @param  \App\Http\Requests\Ticket\TicketCommentRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(TicketCommentRequest $request, Ticket $ticket)
    {
        $this->authorize('create', [TicketComment::class, $ticket]);

        $data = $request->validated();
        $data['ticket_id'] = $ticket->id;

        auth()->user()->comments()->create($data);

        return redirect()->route('tickets.show', $ticket)
            ->withSuccess($this->successMessage('comment', 'created'));
    }

    /**
     * Show the form for editing the specified ticket comment.
     *
     * @param  \App\Models\TicketComment  $comment
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(TicketComment $comment)
    {
        $this->authorize('update', $comment);

        return view('web.tickets.comments.edit', compact('comment'));
    }

    /**
     * Update the specified ticket comment.
     *
     * @param  \App\Http\Requests\Ticket\TicketCommentRequest  $request
     * @param  \App\Models\TicketComment  $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(TicketCommentRequest $request, TicketComment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return redirect()->route('tickets.show', $comment->ticket)
            ->withSuccess($this->successMessage('comment', 'updated'));
    }

    /**
     * Remove the specified ticket comment.
     *
     * @param  \App\Models\TicketComment  $comment
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(TicketComment $comment)
    {
        $this->authorize('delete', $comment);

        if (!$comment->delete()) {
            return redirect()->route('tickets.comments.edit', $comment)
                ->withFail($this->failMessage('comment', 'deleted'));
        }

        return redirect()->route('tickets.show', $comment->ticket)
            ->withSuccess($this->successMessage('comment', 'deleted'));
    }
}
