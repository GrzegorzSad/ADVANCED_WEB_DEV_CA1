<?php

namespace App\Http\Controllers;
use App\Models\Song;

use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all(); // Retrieve playlists from the database
        return view('playlists', ['playlists' => $playlists]);
    }

    public function create()
    {
        // Fetch a list of available songs
        $songOptions = Song::all();

        return view('playlist.create', ['songOptions' => $songOptions]);
    }

    public function store(Request $request)
    {
        // $validatedData['creation_date'] = now(); // or use a specific date if needed
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'description' => 'string|nullable',
            'image' => 'image|nullable',
        ]);

        // Process image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/playlists', 'public');
            $validatedData['image_url'] = asset('storage/' . $imagePath);
        }

        // Set the creation_date to the current date and time
        

        // Create and save the playlist record
        $newPlaylist = Playlist::create($validatedData);

        // You can also attach selected songs here if you have a many-to-many relationship

        return redirect('/playlists/' . $newPlaylist->id)->with('success', 'Playlist created successfully');
    }

    public function show(Playlist $playlist)
    {
        return view('playlist.show', ['playlist' => $playlist]);
    }

    public function edit(Playlist $playlist)
    {
        return view('playlist.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        // Add validation for playlists here

        $playlist->update($validatedData);

        return redirect()->route('playlists.show', $playlist->id)->with('success', 'Playlist updated successfully');
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();

        return redirect()->route('playlists.index')->with('success', 'Playlist deleted successfully');
    }
}