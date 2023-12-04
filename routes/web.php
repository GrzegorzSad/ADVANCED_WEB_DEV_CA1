<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\SongController as AdminSongController;
use App\Http\Controllers\Admin\AlbumController as AdminAlbumController;
use App\Http\Controllers\Admin\PlaylistController as AdminPlaylistController;

use App\Http\Controllers\User\SongController as UserSongController;
use App\Http\Controllers\User\AlbumController as UserAlbumController;
use App\Http\Controllers\User\PlaylistController as UserPlaylistController;


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

Route::get('/admin/songs', [AdminSongController::class, 'index'])->middleware(['auth'])->name('admin.songs.index');
Route::get('/admin/songs/create', [AdminSongController::class, 'create'])->middleware(['auth'])->name('admin.songs.create');
Route::post('/admin/songs', [AdminSongController::class, 'store'])->middleware(['auth'])->name('admin.songs.store');
Route::get('/admin/songs/{song}', [AdminSongController::class, 'show'])->middleware(['auth'])->name('admin.songs.show');
Route::get('/admin/songs/{song}/edit', [AdminSongController::class, 'edit'])->middleware(['auth'])->name('admin.songs.edit');;
Route::put('/admin/songs/{song}', [AdminSongController::class, 'update'])->middleware(['auth'])->name('admin.songs.update');
Route::delete('/admin/songs/{song}', [AdminSongController::class, 'destroy'])->middleware(['auth'])->name('admin.songs.destroy');
Route::get('/admin/songs/{song}/add-to-playlist', [AdminSongController::class, 'addToPlaylist'])->middleware(['auth'])->name('admin.songs.addToPlaylist');
Route::post('/admin/songs/{song}/add-to-playlist', [AdminSongController::class, 'addSongToPlaylist'])->middleware(['auth'])->name('admin.songs.addSongToPlaylist');
Route::get('/admin/songs/{song}/add-to-album', [AdminSongController::class, 'addToAlbum'])->middleware(['auth'])->name('admin.songs.addToAlbum');
Route::post('/admin/songs/{song}/add-to-album', [AdminSongController::class, 'addSongToAlbum'])->middleware(['auth'])->name('admin.songs.addSongToAlbum');


Route::get('/admin/albums', [AdminAlbumController::class, 'index'])->middleware(['auth'])->name('admin.albums.index');
Route::get('/admin/albums/create', [AdminAlbumController::class, 'create'])->middleware(['auth'])->name('admin.albums.create');
Route::post('/admin/albums', [AdminAlbumController::class, 'store'])->middleware(['auth'])->name('admin.albums.store');
Route::get('/admin/albums/{album}', [AdminAlbumController::class, 'show'])->middleware(['auth'])->name('admin.albums.show');
Route::get('/admin/albums/{album}/edit', [AdminAlbumController::class, 'edit'])->middleware(['auth'])->name('admin.albums.edit');
Route::put('/admin/albums/{album}', [AdminAlbumController::class, 'update'])->middleware(['auth'])->name('admin.albums.update');
Route::delete('/admin/albums/{album}', [AdminAlbumController::class, 'destroy'])->middleware(['auth'])->name('admin.albums.destroy');
Route::delete('/admin/albums/{album}', [AdminAlbumController::class, 'destroy'])->middleware(['auth'])->name('admin.albums.destroy');
Route::delete('/admin/albums/{album}/songs/{song}', [AdminAlbumController::class, 'detachSong'])->middleware(['auth'])->name('admin.album.song.detach');


Route::get('/admin/playlists', [AdminPlaylistController::class, 'index'])->middleware(['auth'])->name('admin.playlists.index');
Route::get('/admin/playlists/create', [AdminPlaylistController::class, 'create'])->middleware(['auth'])->name('admin.playlists.create');
Route::post('/admin/playlists', [AdminPlaylistController::class, 'store'])->middleware(['auth'])->name('admin.playlists.store');
Route::get('/admin/playlists/{playlist}', [AdminPlaylistController::class, 'show'])->middleware(['auth'])->name('admin.playlists.show');
Route::get('/admin/playlists/{playlist}/edit', [AdminPlaylistController::class, 'edit'])->middleware(['auth'])->name('admin.playlists.edit');
Route::put('/admin/playlists/{playlist}', [AdminPlaylistController::class, 'update'])->middleware(['auth'])->name('admin.playlists.update');
Route::delete('/admin/playlists/{playlist}', [AdminPlaylistController::class, 'destroy'])->middleware(['auth'])->name('admin.playlists.destroy');
Route::delete('/admin/playlists/{playlist}/songs/{song}', [AdminPlaylistController::class, 'detachSong'])->middleware(['auth'])->name('admin.playlist.song.detach');


Route::get('/user/songs', [UserSongController::class, 'index'])->name('user.songs.index');
Route::get('/user/songs/{song}', [UserSongController::class, 'show'])->name('user.songs.show');

Route::get('/user/albums', [UserAlbumController::class, 'index'])->name('user.albums.index');
Route::get('/user/albums/{album}', [UserAlbumController::class, 'show'])->name('user.albums.show');

Route::get('/user/playlists', [UserPlaylistController::class, 'index'])->name('user.playlists.index');
Route::get('/user/playlists/create', [UserPlaylistController::class, 'create'])->name('user.playlists.create');
Route::post('/user/playlists', [UserPlaylistController::class, 'store'])->name('user.playlists.store');
Route::get('/user/playlists/{playlist}', [UserPlaylistController::class, 'show'])->name('user.playlists.show');
Route::get('/user/playlists/{playlist}/edit', [UserPlaylistController::class, 'edit'])->name('user.playlists.edit');
Route::put('/user/playlists/{playlist}', [UserPlaylistController::class, 'update'])->name('user.playlists.update');
Route::delete('/user/playlists/{playlist}', [UserPlaylistController::class, 'destroy'])->name('user.playlists.destroy');
Route::delete('/user/playlists/{playlist}/songs/{song}', [UserPlaylistController::class, 'detachSong'])->name('user.playlist.song.detach');

require __DIR__.'/auth.php';


 