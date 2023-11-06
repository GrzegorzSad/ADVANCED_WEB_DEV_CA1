<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Playlist
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('playlists.update', $playlist->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                
                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Playlist Title"
                        class="w-full"
                        :value="$playlist->title"
                    ></x-text-input>
                
                    <x-text-input
                        type="text"
                        name="user"
                        field="user"
                        placeholder="User..."
                        class="w-full mt-6"
                        :value="$playlist->user"
                    ></x-text-input>
                
                    <x-text-area
                        type="text"
                        name="description"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="$playlist->description"
                    ></x-text-area>
                
                    <input type="file" name="image" id="image" class="w-full mt-6">

                    <div class="mt-6">
                        <x-primary-button type="submit">Update Playlist</x-primary-button>
                    </div>
                </form>
                    
                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-2">Songs in the Playlist</h3>
                        @if ($playlist->songs->count() > 0)
                            <ul>
                                @foreach ($playlist->songs as $song)
                                    <li>
                                        {{ $song->name }}
                                        <form action="{{ route('playlist.song.detach', ['playlist' => $playlist, 'song' => $song]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Remove</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No songs in this playlist.</p>
                        @endif
                    </div>
                
            </div>
        </div>
    </div>
</x-app-layout>