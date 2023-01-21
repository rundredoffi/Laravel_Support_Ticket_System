<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabelRequest;
use App\Models\Label;

class LabelController extends Controller
{
    /**
     * Display the page with label list.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Label::class);

        $labels = Label::select(['id', 'name', 'created_at'])
            ->latest()
            ->paginate(20);

        return view('web.labels.index', compact('labels'));
    }

    /**
     * Show the form for creating a new label.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Label::class);

        return view('web.labels.create');
    }

    /**
     * Store a newly created label.
     *
     * @see \App\Observers\LabelObserver::created()  Clears the cache.
     *
     * @param  \App\Http\Requests\LabelRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(LabelRequest $request)
    {
        $this->authorize('create', Label::class);

        Label::create($request->validated());

        return redirect()->route('labels.index')
            ->withSuccess($this->successMessage('label', 'created'));
    }

    /**
     * Show the form for editing the specified label.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Label $label)
    {
        $this->authorize('update', $label);

        return view('web.labels.edit', compact('label'));
    }

    /**
     * Update the specified label.
     *
     * @see \App\Observers\LabelObserver::updated()  Clears the cache.
     *
     * @param  \App\Http\Requests\LabelRequest  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(LabelRequest $request, Label $label)
    {
        $this->authorize('update', $label);

        $label->update($request->validated());

        return redirect()->route('labels.edit', $label)
            ->withSuccess($this->successMessage('label', 'updated'));
    }

    /**
     * Remove the specified label.
     *
     * @see \App\Observers\LabelObserver::deleted()  Clears the cache.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Label $label)
    {
        $this->authorize('delete', $label);

        if (!$label->delete()) {
            return redirect()->route('labels.edit', $label)
                ->withFail($this->failMessage('label', 'deleted'));
        }

        return redirect()->route('labels.index')
            ->withSuccess($this->successMessage('label', 'deleted'));
    }
}
