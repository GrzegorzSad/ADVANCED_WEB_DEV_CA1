<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Song;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return view('albums', ['albums' => $albums]);
    }

    public function create()
    {
        return view('album.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'description' => 'string|nullable',
            'image' => 'image|nullable',
            'release_date' => 'date',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $validatedData['image_url'] = asset('storage/' . str_replace('public/', '', $imagePath));
        }

        $newAlbum = Album::create($validatedData);

        return redirect()->route('albums.show', $newAlbum->id)->with('success', 'Album created successfully');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'description' => 'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'release_date' => 'date',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('public/images', $imageName);
            $album->image_url = 'storage/images/' . $imageName;
        }

        $album->update($request->only('name', 'artist', 'description', 'release_date'));

        return redirect()->route('albums.show', $album->id)->with('success', 'Album updated successfully');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully');
    }

    public function detachSong(Album $album, Song $song)
    {
        // Ensure that the song belongs to the specified album
        if ($song->album_id === $album->id) {
            // Option 1: Update the song's album_id to null (disassociation)
            // $song->album_id = null;
            // $song->save();

            // Option 2: Delete the song (removes it from the album)
            $song->delete();

            return redirect()->route('albums.edit', $album)->with('success', 'Song removed from album');
        }

        return redirect()->route('albums.edit', $album)->with('error', 'Song does not belong to this album');
    }
}