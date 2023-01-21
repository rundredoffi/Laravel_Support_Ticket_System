<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the page with user list.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the target user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $target)
    {
        return $user->id === $target->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can update the role of the target user.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $target
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function changeRole(User $user, User $target)
    {
        return $user->id !== $target->id && $user->isAdmin();
    }
}
