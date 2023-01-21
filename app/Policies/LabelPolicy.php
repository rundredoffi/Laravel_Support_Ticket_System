<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the page with label list.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create labels.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the label.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Label $label)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the label.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Label $label)
    {
        return $user->isAdmin();
    }
}
