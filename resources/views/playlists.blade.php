<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Playlists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <ul>
                        @foreach($playlists as $playlist)
                            <li>
                                <a href="{{ route('playlists.show', ['playlist' => $playlist]) }}">
                                    {{ $playlist->title }}
                                </a>
                            </li>
                            {{-- <li>
                                <strong>Songs:</strong>
                                <ul>
                                    @foreach ($playlist->songs as $song)
                                        <li>
                                            <a href="{{ route('songs.show', ['song' => $song]) }}">
                                                {{ $song->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <br> --}}
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>