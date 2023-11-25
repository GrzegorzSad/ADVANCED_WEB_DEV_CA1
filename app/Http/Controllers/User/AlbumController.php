<?php

namespace App\Http\Controllers\User;
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
        $user->authorizeRoles('user');

        $albums = Album::all();
        return view('user.albums.index', ['albums' => $albums]);
    }



    public function show(Album $album)
    {
        
        $user= Auth::user();
        $user->authorizeRoles('user');
        
        return view('user.albums.show', ['album' => $album]);
    }

    
}