<div>
    <h2 class="text-xl font-bold mb-4">📊 Reports</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-2">Top 10 Most Borrowed Books</h3>
            <ul class="list-disc pl-5 text-sm">
                @foreach ($topBooks as $book)
                    <li>{{ $book->title }} ({{ $book->borrowed }} times)</li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-2">Top 10 Active Readers</h3>
            <ul class="list-disc pl-5 text-sm">
                @foreach ($topReaders as $user)
                    <li>{{ $user->name }} ({{ $user->bookings_count }} books)</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>