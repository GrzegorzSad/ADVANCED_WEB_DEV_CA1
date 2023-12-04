<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    // public function index()
    // {
    //     if (Auth::check()) {
    //         $user = Auth::user();
    //         $playlists = $user->playlists;
    //         return view('user.playlists.index', ['playlists' => $playlists]);
            
    //     }
    // }
//     public function index()
// {
//     $user = Auth::user();

//     // Fetch playlists created by the authenticated user
//     $userPlaylists = $user->playlists;

//     return view('admin.playlists.index', [
//         'otherUsersPlaylists' => $otherUsersPlaylists,
//         'userPlaylists' => $userPlaylists,
//     ]);

//     $playlists = Playlist::all();

//     return view('admin.playlists.index', ['playlists' => $playlists]);
// }
public function index()
{
    $user = Auth::user();

    // Fetch playlists created by the authenticated user
    $userPlaylists = $user->playlists;

    // Fetch playlists created by other users
    $otherUsersPlaylists = Playlist::where('user_id', '!=', $user->id)->get();

    return view('user.playlists.index', [
        'otherUsersPlaylists' => $otherUsersPlaylists,
        'userPlaylists' => $userPlaylists,
    ]);
}

    public function create()
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        return view('user.playlists.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string|nullable',
            'image' => 'image|nullable',
        ]);

        $newPlaylist = $user->playlists()->create($validatedData);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $newPlaylist->image_url = asset('storage/' . str_replace('public/', '', $imagePath));
            $newPlaylist->save();
        }

        return redirect('/user/playlists/' . $newPlaylist->id)->with('success', 'Playlist created successfully');
    }

    public function show(Playlist $playlist)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');
        $playlist = $playlist->load('user');

        return view('user.playlists.show', ['playlist' => $playlist]);
    }

    public function edit(Playlist $playlist)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');
        $this->authorize('update', $playlist);

        return view('user.playlists.edit', compact('playlist'));
    }
    

    public function update(Request $request, Playlist $playlist)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $imagePath = $request->file('image')->storeAs('public/images', $imageName);
            $playlist->image_url = 'storage/images/' . $imageName;
            $playlist->save();
        }

        $playlist->update($request->only('title', 'description'));

        return redirect()->route('user.playlists.show', $playlist->id)->with('success', 'Playlist updated successfully');
    }

    public function destroy(Playlist $playlist)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $playlist->delete();

        return redirect()->route('user.playlists.index')->with('success', 'Playlist deleted successfully');
    }

    public function detachSong(Playlist $playlist, Song $song)
    {
        $user = Auth::user();
        $user->authorizeRoles('user');

        $playlist->songs()->detach($song);

        return redirect()->route('user.playlists.edit', $playlist->id)->with('success', 'Song removed from playlist');
    }
}