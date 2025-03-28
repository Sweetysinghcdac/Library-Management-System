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
</div>