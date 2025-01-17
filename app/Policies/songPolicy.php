<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Song;
use Illuminate\Auth\Access\HandlesAuthorization;

class songPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Song $song)
    {
        return $song->artist_id == $user->id || $user->role == 'admin';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Song $song)
    {
        return $song->artist_id == $user->id || $user->role == 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Song $song)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Song $song)
    {
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Song $song)
    {
        return $user->role == 'admin';
    }
}
