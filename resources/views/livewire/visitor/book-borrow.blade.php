<div>
    <h2 class="text-xl font-semibold mb-2">{{ $book->title }}</h2>
    <p class="text-gray-600">By {{ $book->author }}</p>
    <p class="text-sm my-2">Available Stock: {{ $book->stock }}</p>
    <p class="text-sm text-gray-700 mb-4">{{ $book->description }}</p>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <button wire:click="borrow" class="bg-blue-600 text-white px-4 py-2 rounded">
        Borrow Book
    </button>
</div>
