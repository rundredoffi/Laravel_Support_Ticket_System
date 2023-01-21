<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the page with user list.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::select(['id', 'created_at', 'first_name', 'last_name', 'role', 'email'])
            ->orderBy('role', 'ASC')
            ->paginate(20);

        return view('web.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('web.users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     *
     * @param  \App\Http\Requests\User\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $message = __('The user has been successfully updated.');
        if ($user->id === auth()->id()) {
            $message = __('Your account has been successfully updated.');
        }

        $user->update($request->validated());

        return redirect()->route('users.edit', $user)
            ->withSuccess($message);
    }
}
