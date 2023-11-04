<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Playlist;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::all(); // Retrieve songs from the database
        return view('songs', ['songs' => $songs]);
    }

    public function create()
    {
        return view('song.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
        ]);

        // Create and save the song record
        $newSong = Song::create($validatedData);

        return redirect('/songs/' . $newSong->id)->with('success', 'Song created successfully');
    }
    

    public function show(Song $song)
    {
        return view('song.show', ['song'=>$song]);
    }

    public function edit(Song $song)
    {
        return view('song.edit', compact('song'));
    }

    public function update(Request $request, Song $song)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'artist' => 'required|string|max:255',
    ]);

    $song->update($validatedData);

    return redirect()->route('songs.show', $song->id)->with('success', 'Song updated successfully');
}

    public function destroy(Song $song)
    {
        $song->delete();

        return redirect()->route('songs.index')->with('success', 'Song deleted successfully');
    }

    public function addToPlaylist(Song $song)
    {
        $playlists = Playlist::all();
        return view('song.addToPlaylist', compact('song', 'playlists'));
    }

    public function addSongToPlaylist(Request $request, Song $song)
    {
        $request->validate([
            'playlist_id' => 'required|exists:playlists,id',
        ]);

        $playlist = Playlist::find($request->playlist_id);

        if ($playlist) {
            $playlist->songs()->attach($song);
        }

        return redirect()->route('songs.show', $song->id)->with('success', 'Song added to the playlist successfully.');
    }

}