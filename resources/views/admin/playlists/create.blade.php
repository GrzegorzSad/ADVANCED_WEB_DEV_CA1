<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ route('admin.playlists.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="creation_date" value="{{ now() }}">

                    <x-text-input
                        type="text"
                        name="title"
                        field="title"
                        placeholder="Playlist Title"
                        class="w-full"
                        autocomplete="off"
                        :value="old('title')"
                    ></x-text-input>

                    {{-- <x-text-input
                        type="text"
                        name="user"
                        field="user"
                        placeholder="User..."
                        class="w-full mt-6"
                        :value="old('user')"
                    ></x-text-input> --}}

                    <x-text-area
                        type="text"
                        name="description"
                        field="description"
                        placeholder="Description..."
                        class="w-full mt-6"
                        :value="old('description')"
                    ></x-text-area>

                    <input type="file" name="image" class="w-full mt-6">

                    <div>
                        <x-primary-button class="mt-6">Create Playlist</x-primary-button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</x-app-layout>