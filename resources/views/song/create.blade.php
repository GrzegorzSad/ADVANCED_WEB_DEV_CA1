<x-app-layout>
    <!-- ... -->
    <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
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
</x-app-layout>