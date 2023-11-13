<?php

namespace App\Http\Controllers\Admin;
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
        $user->authorizeRoles('admin');
        
        $songs = Song::all();
        return view('admin.songs.index', ['songs' => $songs]);
    }

    public function create()
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        return view('admin.songs.create');
    }

    public function store(Request $request)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
        ]);

        $newSong = Song::create($validatedData);

        return redirect('/admin/songs/' . $newSong->id)->with('success', 'Song created successfully');
    }

    public function show(Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        return view('admin.songs.show', ['song' => $song]);
    }

    public function edit(Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        return view('admin.songs.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
        ]);

        $song->update($validatedData);

        return redirect()->route('admin.songs.show', $song->id)->with('success', 'Song updated successfully');
    }

    public function destroy(Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $song->delete();

        return redirect()->route('admin.songs.index')->with('success', 'Song deleted successfully');
    }

    public function addToPlaylist(Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $playlists = Playlist::all();
        return view('admin.songs.addToPlaylist', compact('song', 'playlists'));
    }

    public function addSongToPlaylist(Request $request, Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
        ]);

        $playlist = Playlist::find($request->playlist_id);

        if ($playlist) {
            $playlist->songs()->attach($song);
        }

        return redirect()->route('admin.songs.show', $song->id)->with('success', 'Song added to the playlist successfully.');
    }

    public function addToAlbum(Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $albums = Album::all();
        return view('admin.songs.addToAlbum', compact('song', 'albums'));
    }

    public function addSongToAlbum(Request $request, Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $request->validate([
            'album_id' => 'required|exists:albums,id',
        ]);

        $album = Album::find($request->album_id);

        if ($album) {
            $album->songs()->save($song);
        }

        return redirect()->route('admin.songs.show', $song->id)->with('success', 'Song added to the album successfully.');
    }
}