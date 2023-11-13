<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('albums.update', $album->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="Album Name"
                        class="w-full"
                        :value="$album->name"
                    ></x-text-input>

                    <x-text-input
                        type="text"
                        name="artist"
                        field="artist"
                        placeholder="Artist..."
                        class="w-full mt-6"
                        :value="$album->artist"
                    ></x-text-input>

                    <x-text-area
                        type="text"
                        name="description"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="$album->description"
                    ></x-text-area>

                    @if ($album->image_url)
                        <p>Current Image:</p>
                        <img src="{{ asset($album->image_url) }}" alt="Current Album Image">
                    @endif

                    <input type="file" name="image" class="w-full mt-6">

                    <label for="release_date">Release Date:</label>
                        <input type="date" id="release_date" name="release_date" value="{{ $album->release_date ?? '' }}">

                    <div>
                        <x-primary-button class="mt-6">Update Album</x-primary-button>
                    </div>
                </form>
                <h3 class="text-lg font-semibold mb-2">Songs in the Album</h3>
                        @if ($album->songs->count() > 0)
                            <ul>
                                @foreach ($album->songs as $song)
                                    <li>
                                        {{ $song->name }}
                                        <form action="{{ route('album.song.detach', ['album' => $album, 'song' => $song]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Remove</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No songs in this Album.</p>
                        @endif
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>