<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Song;

class AlbumController extends Controller
{
    public function index()
    {
        $user= Auth::user();
        $user->authorizeRoles('admin');

        $albums = Album::all();
        return view('admin.albums.index', ['albums' => $albums]);
    }

    public function create()
    {

        $user= Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.albums.create');
    }

    public function store(Request $request)
    {

        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
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

        return redirect()->route('admin.albums.show', $newAlbum->id)->with('success', 'Album created successfully');
    }

    public function show(Album $album)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        return view('admin.albums.show', ['album' => $album]);
    }

    public function edit(Album $album)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        return view('admin.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
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

        return redirect()->route('admin.albums.show', $album->id)->with('success', 'Album updated successfully');
    }

    public function destroy(Album $album)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album deleted successfully');
    }

    public function detachSong(Album $album, Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        if ($song->album_id === $album->id) {
            $song->delete();

            return redirect()->route('admin.albums.edit', $album)->with('success', 'Song removed from album');
        }

        return redirect()->route('admin.albums.edit', $album)->with('error', 'Song does not belong to this album');
    }
}