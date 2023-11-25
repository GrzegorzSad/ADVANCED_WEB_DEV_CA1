<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $album->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($album->image_url)
                        <img src="{{ asset($album->image_url) }}" alt="Album Image">
                    @endif
                    <p>Name: {{ $album->name }}</p>
                    <p>Artist: {{ $album->artist }}</p>
                    <p>Description: {{ $album->description ?: 'N/A' }}</p>
                    <p>Release Date: {{ $album->release_date }}</p>
                    <h2>Songs in This Album:</h2>
                    <ul>
                        @forelse ($album->songs as $song)
                            <li>{{ $song->name }}</li>
                        @empty
                            <li>No songs in this album.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>