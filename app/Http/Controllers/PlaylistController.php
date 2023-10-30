<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all(); // Retrieve songs from the database
        return view('playlists', ['playlists' => $playlists]);
    }

    public function create()
    {
        // Logic to show a form to create a new playlist
    }

    public function store(Request $request)
    {
        // Logic to store a new playlist in the database
    }

    public function show(Playlist $playlist)
    {
        return view('playlist.show', ['playlist' =>$playlist]);
    }

    public function edit(Playlist $playlist)
    {
        // Logic to show a form to edit an existing playlist
    }

    public function update(Request $request, Playlist $playlist)
    {
        // Logic to update an existing playlist in the database
    }

    public function destroy(Playlist $playlist)
    {
        // Logic to delete a playlist from the database
    }
}