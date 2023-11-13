<x-app-layout>
    <!-- ... -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <form action="{{ route('admin.songs.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <x-text-input
                        type="text"
                        name="name"
                        field="name"
                        placeholder="Song Name"
                        class="w-full"
                        autocomplete="off"
                        :value="old('name')"></x-text-input>

                    <x-text-input
                        type="text"
                        name="category"
                        field="category"
                        placeholder="Category..."
                        class="w-full mt-6"
                        :value="old('category')"></x-text-input>

                    <x-text-input
                        type="text"
                        name="artist"
                        field="artist"
                        placeholder="Artist..."
                        class="w-full mt-6"
                        :value="old('artist')"></x-text-input>

                    <x-primary-button class="mt-6">Save Song</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>