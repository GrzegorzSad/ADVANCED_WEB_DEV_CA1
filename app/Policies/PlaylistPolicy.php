<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Playlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlaylistPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Playlist $playlist)
    {
        return (int)$user->id === (int)$playlist->user_id;
    }

    public function delete(User $user, Playlist $playlist)
    {
        return (int)$user->id === (int)$playlist->user_id;
    }

}
