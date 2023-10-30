<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all(); // Retrieve songs from the database
        return view('albums', ['albums' => $albums]);
    }

    public function create()
    {
        // Logic to show a form to create a new album
    }

    public function store(Request $request)
    {
        // Logic to store a new album in the database
    }

    public function show(Album $album)
    {
        return view('album.show', ['album' =>$album]);
    }

    public function edit(Album $album)
    {
        // Logic to show a form to edit an existing album
    }

    public function update(Request $request, Album $album)
    {
        // Logic to update an existing album in the database
    }

    public function destroy(Album $album)
    {
        // Logic to delete an album from the database
    }
}