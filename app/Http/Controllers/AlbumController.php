<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all(); // Retrieve albums from the database
        return view('albums', ['albums' => $albums]);
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        // Add validation for albums here

        // Create and save the album record
        $newAlbum = Album::create($validatedData);

        return redirect('/albums/' . $newAlbum->id)->with('success', 'Album created successfully');
    }

    public function show(Album $album)
    {
        return view('album.show', ['album' => $album]);
    }

    public function edit(Album $album)
    {
        return view('album.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        // Add validation for albums here

        $album->update($validatedData);

        return redirect()->route('albums.show', $album->id)->with('success', 'Album updated successfully');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully');
    }
}