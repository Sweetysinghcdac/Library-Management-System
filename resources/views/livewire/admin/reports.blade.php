<div class="space-y-6">
    <h2 class="text-3xl font-semibold text-gray-800">📊 Reports</h2>

    <!-- Toggle Buttons -->
    <div class="flex flex-wrap items-center gap-3">
        <button wire:click="showBooks"
                class="px-4 py-2 rounded text-sm font-semibold transition
                {{ $view === 'books' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">
            📚 Top 10 Most Read Books
        </button>
        <button wire:click="showReaders"
                class="px-4 py-2 rounded text-sm font-semibold transition
                {{ $view === 'readers' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-blue-100' }}">
            👤 Top 10 Active Readers
        </button>

        <!-- Export Buttons -->
        <div class="flex gap-2 ml-auto">
            <a href="{{ route('admin.reports.export', ['type' => $view, 'format' => 'pdf']) }}"
            class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                📄 Export PDF
            </a>

            <a href="{{ route('admin.reports.export', ['type' => $view, 'format' => 'csv']) }}"
            class="px-4 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700 transition">
                📁 Export Excel
            </a>
        </div>

    </div>

    <!-- Display Content -->
    @if($view === 'books')
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold text-blue-700 mb-4">📚 Top 10 Most Read Books</h3>
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Author</th>
                        <th class="px-4 py-2">Total Borrowed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topBooks as $index => $book)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $book->title }}</td>
                            <td class="px-4 py-2">{{ $book->author }}</td>
                            <td class="px-4 py-2">{{ $book->bookings_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-6 rounded shadow">
            <h3 class="text-xl font-bold text-blue-700 mb-4">👤 Top 10 Active Readers</h3>
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Books Borrowed</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topReaders as $index => $reader)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $reader->name }}</td>
                            <td class="px-4 py-2">{{ $reader->email }}</td>
                            <td class="px-4 py-2">{{ $reader->bookings_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
