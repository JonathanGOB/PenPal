<?php

namespace App\Policies;

use App\Models\Chatroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatroomPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any chatrooms.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role;
    }

    /**
     * Determine whether the user can view the chatroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return mixed
     */
    public function view(User $user, Chatroom $chatroom)
    {
        return $user->id === $chatroom->id || $user->role;
    }

    /**
     * Determine whether the user can create chatrooms.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the chatroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return mixed
     */
    public function update(User $user, Chatroom $chatroom)
    {
        return $user->id === $chatroom->id || $user->role;
    }

    /**
     * Determine whether the user can delete the chatroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return mixed
     */
    public function delete(User $user, Chatroom $chatroom)
    {
        return $user->id === $chatroom->id || $user->role;
    }

    /**
     * Determine whether the user can restore the chatroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return mixed
     */
    public function restore(User $user, Chatroom $chatroom)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the chatroom.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Chatroom  $chatroom
     * @return mixed
     */
    public function forceDelete(User $user, Chatroom $chatroom)
    {
        return $user->id === $chatroom->id || $user->role;
    }
}
