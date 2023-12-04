<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $playlists = $user->playlists; // Fetch playlists associated with the authenticated user
        return view('admin.playlists.index', ['playlists' => $playlists]);
    }

    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        return view('admin.playlists.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('admin');

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string|nullable',
            'image' => 'image|nullable',
        ]);

        // Associate the playlist with the authenticated user
        $newPlaylist = $user->playlists()->create($validatedData);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $newPlaylist->image_url = asset('storage/' . str_replace('public/', '', $imagePath));
            $newPlaylist->save();
        }

        return redirect('/admin/playlists/' . $newPlaylist->id)->with('success', 'Playlist created successfully');
    }
    public function show(Playlist $playlist)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        return view('admin.playlists.show', ['playlist' => $playlist]);
    }

    public function edit(Playlist $playlist)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        return view('admin.playlists.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $request->validate([
            'title' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'description' => 'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('public/images', $imageName);
            $playlist->image_url = 'storage/images/' . $imageName;
            $playlist->save();
        }

        $playlist->update($request->only('title', 'user', 'description'));

        return redirect()->route('admin.playlists.show', $playlist->id)->with('success', 'Playlist updated successfully');
    }

    public function destroy(Playlist $playlist)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $playlist->delete();

        return redirect()->route('admin.playlists.index')->with('success', 'Playlist deleted successfully');
    }

    public function detachSong(Playlist $playlist, Song $song)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('admin');
        
        $playlist->songs()->detach($song);

        return redirect()->route('admin.playlists.edit', $playlist->id)->with('success', 'Song removed from playlist');
    }
}