{{-- <!DOCTYPE html>
<html>
<head>
    <title>List of Songs</title>
</head>
<body>
    <a href="{{ route('dashboard') }}">Home</a>
    <h1>List of Songs</h1>
    <ul>
        @foreach ($songs as $song)
            <li>
                <a href="{{ route('songs.show', ['song' => $song]) }}">
                    {{ $song->name }}
                </a>
            </li>
        @endforeach
    </ul>
</body>
</html> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Songs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- {{ __("You're logged in!") }} --}}
                    @foreach ($songs as $song)
                        <li>
                            <a href="{{ route('songs.show', ['song' => $song]) }}">
                                {{ $song->name }}
                            </a>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>