<div>
    <h1 class="text-2xl font-bold mb-4">📖 Browse Books</h1>

    <input wire:model.debounce.500ms="search" type="text" placeholder="Search for books..." class="w-full mb-4 p-2 border rounded" />

    @if (session('message'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('message') }}</div>
    @elseif (session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">{{ session('error') }}</div>
    @endif

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($books as $book)
            <div class="bg-white shadow p-4 rounded">
                <h2 class="text-lg font-bold text-blue-700">{{ $book->title }}</h2>
                <p class="text-gray-600">Author: {{ $book->author }}</p>
                <p class="text-gray-500">Available: {{ $book->stock }}</p>
                <p class="text-sm text-gray-700 mb-2">{{ Str::limit($book->description, 100) }}</p>

                <button wire:click="reserve({{ $book->id }})"
                    class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Reserve Book
                </button>
            </div>
        @endforeach
    </div>
</div>
