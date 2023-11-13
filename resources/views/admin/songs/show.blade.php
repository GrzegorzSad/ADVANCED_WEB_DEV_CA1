<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $song->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($song->album)
                        <img src="{{ $song->album->image_url }}">
                    @endif
                    <p>Name: {{ $song->name }}</p>
                    <p>Category: {{ $song->category }}</p>
                    <p>Artist: {{ $song->artist }}</p>

                    <!-- Displaying the associated album -->
                    @if ($song->album)
                        <p>Album: {{ $song->album->name }}</p>
                        <p>Album Release Date: {{ $song->album->release_date }}</p>
                    @else
                        <p>Album: N/A</p>
                    @endif

                    <!-- Displaying the playlists containing this song -->
                    <h2>Playlists Containing This Song</h2>
                    <ul>
                        @forelse ($song->playlists as $playlist)
                            <li>{{ $playlist->title }}</li>
                        @empty
                            <li>No playlists contain this song.</li>
                        @endforelse
                    </ul>

                    <x-primary-button class="mt-6">
                        @if(isset($song))
                            <a href="{{ route('admin.songs.edit', $song->id) }}">Edit Song</a>
                        @else
                            Save Song
                        @endif
                    </x-primary-button>

                    <x-primary-button class="mt-6">
                        <a href="{{ route('admin.songs.addToPlaylist', $song->id) }}">Add to Playlist</a>
                    </x-primary-button>
                    <x-primary-button class="mt-6">
                        <a href="{{ route('admin.songs.addToAlbum', $song->id) }}">Add to Album</a>
                    </x-primary-button>
                </div>

                <x-primary-button href="{{ route('admin.songs.destroy', $song->id) }}"
                    onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this song?')) { document.getElementById('delete-song-form').submit(); }"
                    class="mt-6 block text-center text-white bg-red-600 border border-transparent rounded-md py-2 px-4 text-white focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                    Delete Song
                 </x-primary-button>

                <form id="delete-song-form" action="{{ route('admin.songs.destroy', $song->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>