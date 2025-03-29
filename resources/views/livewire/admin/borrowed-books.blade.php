<div class="space-y-4">
    <h2 class="text-2xl font-semibold">📘 Borrowed Books by Visitors</h2>

    <div class="flex flex-col sm:flex-row items-center gap-3">
        <input type="text" wire:model.defer="search"
               placeholder="Search by book title or visitor name..."
               class="w-full sm:w-1/2 md:w-3/4 border rounded p-2 shadow-sm" />

        <button wire:click="applySearch"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            🔍 Search
        </button>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto shadow-md sm:rounded-lg mt-2">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th class="px-6 py-3">Visitor</th>
                    <th class="px-6 py-3">Book Title</th>
                    <th class="px-6 py-3">Borrowed Date</th>
                    <th class="px-6 py-3">Due Date</th>
                    <th class="px-6 py-3">Returned</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-3">{{ $booking->user->name }}</td>
                        <td class="px-6 py-3">{{ $booking->book->title }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($booking->borrowed_at)->format('d M Y') }}</td>
                        <td class="px-6 py-3">{{ $booking->due_date ? \Carbon\Carbon::parse($booking->due_date)->format('d M Y') : 'N/A' }}</td>
                        <td class="px-6 py-3">
                            {{ $booking->returned_at ? \Carbon\Carbon::parse($booking->returned_at)->format('d M Y') : '⏳ Not Returned' }}
                        </td>
                        <td class="px-6 py-3">
                            <span class="px-2 py-1 rounded-full text-xs {{ $booking->status === 'returned' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            @if ($booking->status !== 'returned')
                                <button
                                    wire:click="sendReminder({{ $booking->id }})"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">
                                    🔔 Send Reminder
                                </button>
                            @else
                                <span class="text-green-600 text-sm">Returned</span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $bookings->links('pagination::tailwind') }}
    </div>
</div>
<script>
    window.addEventListener('swal:success', event => {
        Swal.fire({
            icon: 'success',
            title: event.detail.title,
            text: event.detail.text,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    });

    window.addEventListener('swal:error', event => {
        Swal.fire({
            icon: 'error',
            title: event.detail.title,
            text: event.detail.text,
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    });
</script>
