<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ShowSongController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');
Route::get('/songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');;
Route::put('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
Route::delete('/songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');
Route::get('/songs/{song}/add-to-playlist', [SongController::class, 'addToPlaylist'])->name('songs.addToPlaylist');
Route::post('/songs/{song}/add-to-playlist', [SongController::class, 'addSongToPlaylist'])->name('songs.addSongToPlaylist');



Route::get('/albums', [AlbumController::class, 'index'])->name('albums.index');
Route::get('/albums/create', [AlbumController::class, 'create'])->name('albums.create');
Route::post('/albums', [AlbumController::class, 'store'])->name('albums.store');
Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show');
Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update');
Route::delete('/albums/{album}', [AlbumController::class, 'destroy'])->name('albums.destroy');


Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');
Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
Route::put('/playlists/{playlist}', [PlaylistController::class, 'update'])->name('playlists.update');
Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');
Route::delete('playlists/{playlist}/songs/{song}', [PlaylistController::class, 'detachSong'])->name('playlist.song.detach');

require __DIR__.'/auth.php';