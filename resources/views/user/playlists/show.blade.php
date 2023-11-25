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
                    <p>Creator: {{ $playlist->user }}</p>
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
            </div>
        </div>
    </div>
</x-app-layout>