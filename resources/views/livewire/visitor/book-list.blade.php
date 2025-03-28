<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Available Books</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($books as $book)
            <div class="border p-4 rounded shadow">
                <h3 class="text-lg font-semibold">{{ $book->title }}</h3>
                <p class="text-sm text-gray-600">By {{ $book->author }}</p>
                <p class="text-sm text-gray-500">Category: {{ $book->category }}</p>
                <p class="text-sm mt-2">Stock: {{ $book->stock }}</p>
                <a href="{{ route('visitor.borrow', $book->id) }}" class="mt-2 inline-block bg-blue-600 text-white px-3 py-1 rounded">
                    Borrow
                </a>
            </div>
        @endforeach
    </div>
</div>
