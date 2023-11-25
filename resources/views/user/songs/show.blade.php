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
            </div>
        </div>
    </div>
</x-app-layout>