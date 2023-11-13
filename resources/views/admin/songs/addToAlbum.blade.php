<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add "{{ $song->name }}" to a Album
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('songs.addSongToAlbum', $song->id) }}" method="post">
                        @csrf
                        <select name="album_id" class="form-control">
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                        
                        <x-primary-button class="mt-6" type="submit">Add to Album</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>