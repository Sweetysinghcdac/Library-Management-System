<aside class="w-full md:w-64 bg-white h-auto md:h-screen shadow-md p-6">
    <h2 class="text-2xl font-bold text-blue-600 mb-8">📊 Admin Panel</h2>

    <ul class="space-y-5 text-gray-700">
        <!-- Dashboard -->
        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-2 px-3 py-2 rounded transition font-medium
                    {{ request()->is('admin/dashboard') ? 'bg-blue-100 text-blue-700' : 'text-blue-600 hover:text-blue-800' }}">
                🏠 <span>Dashboard</span>
            </a>
        </li>

        <!-- Manage Books -->
        <li>
            <a href="{{ route('admin.books') }}"
               class="flex items-center gap-2 px-3 py-2 rounded transition font-medium
                    {{ request()->is('admin/books') ? 'bg-blue-100 text-blue-700' : 'text-blue-600 hover:text-blue-800' }}">
                📚 <span>Manage Books</span>
            </a>
        </li>

        <!-- Borrowed Books -->
        <li>
            <a href="{{ route('admin.borrowed-books') }}"
               class="flex items-center gap-2 px-3 py-2 rounded transition font-medium
                    {{ request()->routeIs('admin.borrowed-books') ? 'bg-blue-100 text-blue-700' : 'text-blue-600 hover:text-blue-800' }}">
                📝 <span>Borrowed Books</span>
            </a>
        </li>

        <!-- Reports -->
        <li>
            <a href="{{ route('admin.reports') }}"
               class="flex items-center gap-2 px-3 py-2 rounded transition font-medium
                    {{ request()->is('admin/reports') ? 'bg-blue-100 text-blue-700' : 'text-blue-600 hover:text-blue-800' }}">
                📈 <span>Reports</span>
            </a>
        </li>

        <!-- Logout -->
        <li class="pt-4 border-t">
            <button wire:click="logout"
                    class="flex items-center gap-2 px-3 py-2 rounded text-red-600 hover:text-red-800 font-medium transition">
                🔒 <span>Logout</span>
            </button>
        </li>
    </ul>
</aside>
