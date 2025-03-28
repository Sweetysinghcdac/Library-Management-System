<div class="space-y-6">
    <h1 class="text-3xl font-bold text-gray-800">📖 My Borrowed Books</h1>

    @if (session('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg shadow">{{ session('message') }}</div>
    @elseif (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded-lg shadow">{{ session('error') }}</div>
    @endif

    <div wire:poll.500ms> {{-- Optional: helps keep UI fresh --}}
    <div class="flex flex-wrap gap-4 justify-between mb-4">
    <div class="flex gap-2">
        <a href="{{ route('visitor.books') }}" 
            class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
            📚 Browse More Books
        </a>
    </div>

    <div class="flex flex-wrap items-center gap-2">
        <select wire:model="statusFilter" class="border border-gray-300 rounded px-4 py-2 text-sm shadow-sm">
            <option value="all">All</option>
            <option value="pending">Pending</option>
            <option value="returned">Returned</option>
        </select>

        <input type="date" wire:model="fromDate" class="border border-gray-300 rounded px-3 py-2 text-sm" placeholder="From Date">
        <input type="date" wire:model="toDate" class="border border-gray-300 rounded px-3 py-2 text-sm" placeholder="To Date">
    </div>
</div>

    
    </div>


    @if ($bookings->isEmpty())
        <div class="text-gray-600 text-lg">
            No bookings found. Start exploring our collection 
            <a href="{{ route('visitor.books') }}" class="text-blue-600 font-semibold hover:underline">📚 Browse Books</a>!
        </div>
    @else
        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach ($bookings as $booking)
        <div wire:key="booking-{{ $booking->id }}" class="bg-white p-5 rounded-xl ...">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-bold text-blue-800">{{ $booking->book->title }}</h3>
                        <span class="text-sm px-3 py-1 rounded-full
                            {{ $booking->status === 'returned' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>

                    <div class="text-sm text-gray-700 space-y-1">
                        <p><strong>📅 Borrowed:</strong> {{ \Carbon\Carbon::parse($booking->borrowed_at)->format('d M Y') }}</p>
                        <p><strong>📆 Due:</strong> {{ $booking->due_date ? \Carbon\Carbon::parse($booking->due_date)->format('d M Y') : 'N/A' }}</p>
                        <p><strong>✅ Returned:</strong> 
                            {{ $booking->returned_at ? \Carbon\Carbon::parse($booking->returned_at)->format('d M Y') : '⏳ Not Returned' }}
                        </p>
                    </div>

                    @if ($booking->status !== 'returned')
                        <div class="mt-4">
                            <button wire:click="markAsReturned({{ $booking->id }})"
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md text-sm font-semibold transition">
                                ✅ Mark as Returned
                            </button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex justify-center">
            {{ $bookings->links('pagination::tailwind') }}
        </div>
    @endif

    <div class="mt-10 text-sm text-gray-500">
        Need help? Visit the help center or contact the librarian.
    </div>
</div>
