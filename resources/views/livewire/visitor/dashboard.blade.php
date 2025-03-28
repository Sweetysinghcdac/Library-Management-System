<div>
    <h1 class="text-2xl font-bold mb-6">📚 My Borrowed Books</h1>

    @if ($bookings->isEmpty())
        <p class="text-gray-600">You haven’t borrowed any books yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="w-full table-auto border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 text-left">Title</th>
                        <th class="p-2">Borrowed At</th>
                        <th class="p-2">Returned At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="border-t">
                            <td class="p-2">{{ $booking->book->title }}</td>
                            <td class="p-2">{{ $booking->borrowed_at->format('d M Y') }}</td>
                            <td class="p-2">
                                {{ $booking->returned_at ? $booking->returned_at->format('d M Y') : '⏳ Not yet returned' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>