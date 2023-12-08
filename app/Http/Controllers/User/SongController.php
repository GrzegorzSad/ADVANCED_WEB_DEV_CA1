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

    public function addToPlaylist(Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $playlists = $user->playlists;

        return view('user.songs.addToPlaylist', compact('song', 'playlists'));
    }

    public function addSongToPlaylist(Request $request, Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('user');
        
        $request->validate([
            'playlist_id' => 'required|exists:playlists,id,user_id,' . $user->id,
        ]);

        $playlist = Playlist::find($request->playlist_id);

        if ($playlist) {
            $playlist->songs()->attach($song);
        }

        return redirect()->route('user.songs.show', $song->id)->with('success', 'Song added to the playlist successfully.');
    }

    

}