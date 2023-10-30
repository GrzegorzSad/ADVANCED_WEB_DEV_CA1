<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;

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
            // 'playlist_id' => 'required|exists:playlists,id',
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
        // Logic to show a form to edit an existing song
    }

    public function update(Request $request, Song $song)
    {
        // Logic to update an existing song in the database
    }

    public function destroy(Song $song)
    {
        // Logic to delete a song from the database
    }
}