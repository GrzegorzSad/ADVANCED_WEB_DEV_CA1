<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Playlist;
use App\Models\Album;

class SongController extends Controller
{
    public function index()
    {
        
        $user= Auth::user();
        $user->authorizeRoles('user');
        
        $songs = Song::all();
        return view('user.songs.index', ['songs' => $songs]);
    }

    public function show(Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('user');
        
        return view('user.songs.show', ['song' => $song]);
    }
}