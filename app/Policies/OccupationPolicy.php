<?php

namespace App\Policies;

use App\Models\Occupation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OccupationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tags.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function before($user, $ability)
    {
        if ($user->role) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any occupations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the occupation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Occupation  $occupation
     * @return mixed
     */
    public function view(User $user, Occupation $occupation)
    {
        //
    }

    /**
     * Determine whether the user can create occupations.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the occupation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Occupation  $occupation
     * @return mixed
     */
    public function update(User $user, Occupation $occupation)
    {
        //
    }

    /**
     * Determine whether the user can delete the occupation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Occupation  $occupation
     * @return mixed
     */
    public function delete(User $user, Occupation $occupation)
    {
        //
    }

    /**
     * Determine whether the user can restore the occupation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Occupation  $occupation
     * @return mixed
     */
    public function restore(User $user, Occupation $occupation)
    {
        //
    }

    public function store(User $user)
    {

    }

    /**
     * Determine whether the user can permanently delete the occupation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Occupation  $occupation
     * @return mixed
     */
    public function forceDelete(User $user, Occupation $occupation)
    {
        //
    }
}
