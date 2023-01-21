<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriorityRequest;
use App\Models\Priority;

class PriorityController extends Controller
{
    /**
     * Display the page with priority list.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Priority::class);

        $priorities = Priority::select(['id', 'name', 'created_at'])
            ->latest()
            ->paginate(20);

        return view('web.priorities.index', compact('priorities'));
    }

    /**
     * Show the form for creating a new priority.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Priority::class);

        return view('web.priorities.create');
    }

    /**
     * Store a newly created priority.
     *
     * @see \App\Observers\PriorityObserver::created()  Clears the cache.
     *
     * @param  \App\Http\Requests\PriorityRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(PriorityRequest $request)
    {
        $this->authorize('create', Priority::class);

        Priority::create($request->validated());

        return redirect()->route('priorities.index')
            ->withSuccess($this->successMessage('priority', 'created'));
    }

    /**
     * Show the form for editing the specified priority.
     *
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Priority $priority)
    {
        $this->authorize('update', $priority);

        return view('web.priorities.edit', compact('priority'));
    }

    /**
     * Update the specified priority.
     *
     * @see \App\Observers\PriorityObserver::updated()  Clears the cache.
     *
     * @param  \App\Http\Requests\PriorityRequest  $request
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PriorityRequest $request, Priority $priority)
    {
        $this->authorize('update', $priority);

        $priority->update($request->validated());

        return redirect()->route('priorities.edit', $priority)
            ->withSuccess($this->successMessage('priority', 'updated'));
    }

    /**
     * Remove the specified priority.
     *
     * @see \App\Observers\PriorityObserver::deleted()  Clears the cache.
     *
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Priority $priority)
    {
        $this->authorize('delete', $priority);

        if (!$priority->delete()) {
            return redirect()->route('priorities.edit', $priority)
                ->withFail($this->failMessage('priority', 'deleted'));
        }

        return redirect()->route('priorities.index')
            ->withSuccess($this->successMessage('priority', 'deleted'));
    }
}
