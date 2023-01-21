<?php

namespace App\Policies;

use App\Models\Priority;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PriorityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the page with priority list.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create priorities.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the priority.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Priority $priority)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the priority.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Priority  $priority
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Priority $priority)
    {
        return $user->isAdmin();
    }
}
