<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $playlist->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($playlist->image_url)
                        <img src="{{ asset($playlist->image_url) }}" alt="Playlist Image">
                    @endif
                    <p>Title: {{ $playlist->title }}</p>
                    <p>Creator: {{ $playlist->user->name }}</p>
                    <p>Description: {{ $playlist->description ?: 'N/A' }}</p>
                    
                    <p>Creation Date: {{ $playlist->creation_date }}</p>

                    <!-- Displaying songs in the playlist -->
                    <h2>Songs in This Playlist:</h2>
                    <ul>
                        @forelse ($playlist->songs as $song)
                            <li>{{ $song->name }}</li>
                        @empty
                            <li>No songs in this playlist.</li>
                        @endforelse
                    </ul>
                </div>
                @can('update', $playlist)
                <x-primary-button class="mt-6">
                    @if (isset($playlist))
                        <a href="{{ route('user.playlists.edit', $playlist->id) }}">Edit Playlist</a>
                    @else
                        Save Playlist
                    @endif
                </x-primary-button>
                @endcan

                @can('delete', $playlist)
                <x-primary-button href="{{ route('user.playlists.destroy', $playlist->id) }}"
                    onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this playlist?')) { document.getElementById('delete-playlist-form').submit(); }"
                    class="mt-6 block text-center text-white bg-red-600 border border-transparent rounded-md py-2 px-4 text-white focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                    Delete Playlist
                </x-primary-button>
                @endcan
                <form id="delete-playlist-form" action="{{ route('user.playlists.destroy', $playlist->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
                <br>
            </div>
        </div>
    </div>
</x-app-layout>