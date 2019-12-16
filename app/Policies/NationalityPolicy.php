<?php

namespace App\Policies;

use App\Models\Nationality;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NationalityPolicy
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
     * Determine whether the user can view any nationalities.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * @param User $user
     */
    public function store(User $user)
    {

    }

    /**
     * Determine whether the user can view the nationality.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nationality  $nationality
     * @return mixed
     */
    public function view(User $user, Nationality $nationality)
    {
        //
    }

    /**
     * Determine whether the user can create nationalities.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the nationality.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nationality  $nationality
     * @return mixed
     */
    public function update(User $user, Nationality $nationality)
    {
        //
    }

    /**
     * Determine whether the user can delete the nationality.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nationality  $nationality
     * @return mixed
     */
    public function delete(User $user, Nationality $nationality)
    {
        //
    }

    /**
     * Determine whether the user can restore the nationality.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nationality  $nationality
     * @return mixed
     */
    public function restore(User $user, Nationality $nationality)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the nationality.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Nationality  $nationality
     * @return mixed
     */
    public function forceDelete(User $user, Nationality $nationality)
    {
        //
    }
}
