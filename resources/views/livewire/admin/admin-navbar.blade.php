<aside class="w-full md:w-64 bg-white h-auto md:h-screen shadow-md p-6">
    <h2 class="text-2xl font-bold text-blue-600 mb-8">📊 Admin Panel</h2>

    <ul class="space-y-5 text-gray-700">
        <!-- Dashboard -->
        <li>
            <a href="/admin/dashboard"
               class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
                🏠 <span>Dashboard</span>
            </a>
        </li>

        <!-- Manage Books -->
        <li>
            <a href="/admin/books"
               class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
                📚 <span>Manage Books</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.borrowed-books') }}"
            class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
                📝 <span>Borrowed Books</span>
            </a>
        </li>

        <!-- Reports -->
        <li>
            <a href="/admin/reports"
               class="flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition">
                📈 <span>Reports</span>
            </a>
        </li>

        <!-- Logout -->
        <li class="pt-4 border-t">
            <button wire:click="logout"
                    class="flex items-center gap-2 text-red-600 hover:text-red-800 font-medium transition">
                🔒 <span>Logout</span>
            </button>
        </li>
    </ul>
</aside>
