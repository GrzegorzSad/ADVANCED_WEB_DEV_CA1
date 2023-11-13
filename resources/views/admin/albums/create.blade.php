<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Album') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.albums.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="Album Name"
                        class="w-full"
                        autocomplete="off"
                        :value="old('name')"
                    ></x-text-input>

                    <x-text-input
                        type="text"
                        name="artist"
                        field="artist"
                        placeholder="Artist..."
                        class="w-full mt-6"
                        :value="old('artist')"
                    ></x-text-input>

                    <x-text-area
                        type="text"
                        name="description"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="old('description')"
                    ></x-text-area>

                    <input type="file" name="image" class="w-full mt-6">

                    <label for="release_date">Release Date:</label>
                        <input type="date" id="release_date" name="release_date" value="{{ $album->release_date ?? '' }}">

                    <div>
                        <x-primary-button class="mt-6">Create Album</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>