<?php

namespace App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public function index()
    {
        
        $user= Auth::user();
        $user->authorizeRoles('user');
        
        $playlists = Playlist::all();
        return view('user.playlists.index', ['playlists' => $playlists]);
    }


    public function show(Playlist $playlist)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('user');
        
        return view('user.playlists.show', ['playlist' => $playlist]);
    }

   
}