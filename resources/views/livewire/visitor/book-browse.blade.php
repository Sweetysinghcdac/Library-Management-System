<div class="space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">📖 Browse Books</h1>

    {{-- Search Input --}}
    <div class=" ml-5">
        <input wire:model.defer="search"
               type="text"
               placeholder="Search for books..."
               class="w-80%  sm:w-1/2 md:w-3/4 p-3 border rounded shadow-sm focus:outline-none focus:ring focus:border-blue-300"
        />
        <button wire:click="searchBooks"
                class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition text-sm">
            🔍 Search
        </button>
    </div>
    

    {{-- Success Message --}}
    @if ($successMessage)
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 2000)" 
            x-transition:leave="transition ease-in duration-500"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="bg-green-100 text-green-700 p-3 rounded shadow-sm"
            x-cloak
        >
            {{ $successMessage }}
        </div>
    @endif


    @error('stock')
        <div 
            x-data="{ show: true }" 
            x-show="show" 
            x-init="setTimeout(() => show = false, 2000)" 
            class="bg-red-100 text-red-700 p-3 rounded shadow-sm"
            x-cloak
            x-transition
        >
            {{ $message }}
        </div>
    @enderror


    {{-- Book Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($books as $book)
            <div class="bg-white shadow rounded-lg p-3 text-sm flex flex-col justify-between max-w-xs w-full mx-auto">
                <div>
                    <h2 class="text-base font-semibold text-blue-700 mb-1">{{ $book->title }}</h2>
                    <p class="text-gray-600">Author: {{ $book->author }}</p>
                    <p class="text-gray-500 mb-2">Available: {{ $book->stock }}</p>
                    <p class="text-gray-700">{{ Str::limit($book->description, 80) }}</p>
                </div>

                <button wire:click="reserve({{ $book->id }})"
                        class="mt-3 w-full bg-blue-600 text-white px-3 py-1.5 rounded text-sm hover:bg-blue-700 transition">
                    📚 Reserve Book
                </button>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-600 text-sm">
                No books found. Try a different search.
            </div>
        @endforelse
    </div>


    {{-- Pagination Info --}}
    @if ($books->total() > 0)
        <div class="text-sm text-gray-500 mt-4 text-center">
            Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} results
        </div>
    @endif

    {{-- Pagination Links --}}
    <div class="mt-6 px-4 flex justify-center">
        {{ $books->links('pagination::tailwind') }}
    </div>
</div>
