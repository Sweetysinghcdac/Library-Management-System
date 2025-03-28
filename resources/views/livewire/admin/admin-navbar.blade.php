<aside class="w-64 h-screen bg-white shadow-md p-4">
    <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
    <ul class="space-y-4">
        <li><a href="/admin/books" class="text-blue-600 hover:underline">Manage Books</a></li>
        <li><a href="/admin/reports" class="text-blue-600 hover:underline">Reports</a></li>
        <li>
            <button wire:click="logout" class="text-red-500 hover:underline">Logout</button>
        </li>
    </ul>
</aside>
