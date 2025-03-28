{{-- resources/views/livewire/visitor/dashboard.blade.php --}}
<div class="space-y-6">
    <h1 class="text-3xl font-bold text-gray-800">📖 Visitor Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        {{-- Book a Book Card --}}
        <a href="{{ route('visitor.books') }}" class="block bg-white p-6 rounded-xl shadow hover:shadow-md transition border border-gray-200">
            <div class="text-2xl font-semibold text-blue-700">📚 Browse & Reserve</div>
            <p class="text-gray-600 mt-2">Search and reserve books available in the library.</p>
        </a>

        {{-- Borrowed History Card --}}
        <a href="" class="block bg-white p-6 rounded-xl shadow hover:shadow-md transition border border-gray-200">
            <div class="text-2xl font-semibold text-green-700">📘 My Borrowed Books</div>
            <p class="text-gray-600 mt-2">View your past and current book borrowings.</p>
        </a>

        {{-- Profile Access --}}
        <a href="{{ route('profile') }}" class="block bg-white p-6 rounded-xl shadow hover:shadow-md transition border border-gray-200">
            <div class="text-2xl font-semibold text-gray-700">👤 My Profile</div>
            <p class="text-gray-600 mt-2">Manage your personal information.</p>
        </a>
    </div>

    <div class="mt-10">
        <p class="text-gray-500 text-sm">Need help? Visit the help center or contact the librarian.</p>
    </div>
</div>
