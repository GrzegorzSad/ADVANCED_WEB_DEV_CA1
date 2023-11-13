<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(isset($song))
                {{ __('Edit Song') }}
            @else
                {{ __('Create Song') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form
                    @if(isset($song))
                        action="{{ route('songs.update', $song->id) }}"
                        method="post"
                    @else
                        action="{{ route('songs.store') }}"
                        method="post"
                    @endif
                    enctype="multipart/form-data">
                    @csrf
                    @if(isset($song))
                        @method('PUT')
                    @endif

                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="Song Name"
                        class="w-full"
                        autocomplete="off"
                        :value="isset($song) ? $song->name : old('name')"></x-text-input>

                    <x-text-input
                        type="text"
                        name="category"
                        field="category"
                        placeholder="Category..."
                        class="w-full mt-6"
                        :value="isset($song) ? $song->category : old('category')"></x-text-input>

                    <x-text-input
                        type="text"
                        name="artist"
                        field="artist"
                        placeholder="Artist..."
                        class="w-full mt-6"
                        :value="isset($song) ? $song->artist : old('artist')"></x-text-input>

                    <x-primary-button class="mt-6">
                        @if(isset($song))
                            {{ __('Update Song') }}
                        @else
                            {{ __('Save Song') }}
                        @endif
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
