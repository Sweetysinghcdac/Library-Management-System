<div>
    <h1 class="text-2xl font-bold mb-6">📊 Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">📚 Total Books</h3>
            <p class="text-3xl mt-2">{{ $bookCount }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">📖 Books Borrowed</h3>
            <p class="text-3xl mt-2">{{ $borrowedCount }}</p>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-lg font-semibold">👤 Active Readers</h3>
            <p class="text-3xl mt-2">{{ $readerCount }}</p>
        </div>
    </div>

    <!-- Overdue Visitors Section -->
    <div class="mt-8 bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4 text-red-600">⏰ Overdue Visitors (Not Returned)</h2>

        @if ($overdueBookings->count())
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs bg-gray-100 text-gray-700 uppercase">
                        <tr>
                            <th class="px-4 py-2">Visitor</th>
                            <th class="px-4 py-2">Book Title</th>
                            <th class="px-4 py-2">Borrowed Date</th>
                            <th class="px-4 py-2">Due Date</th>
                            <th class="px-4 py-2">Days Overdue</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($overdueBookings as $booking)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $booking->user->name }}</td>
                                <td class="px-4 py-2">{{ $booking->book->title }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($booking->borrowed_at)->format('d M Y') }}</td>
                                <td class="px-4 py-2 text-red-600">{{ \Carbon\Carbon::parse($booking->due_date)->format('d M Y') }}</td>
                                <td class="px-4 py-2 text-red-600 font-semibold">
                                    {{ \Carbon\Carbon::parse($booking->due_date)->diffInDays(now()) }} days
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No overdue records found.</p>
        @endif
    </div>
</div>
