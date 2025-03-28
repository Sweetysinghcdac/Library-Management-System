<nav class="bg-white shadow-md h-screen w-64 p-6">
    <h1 class="text-xl font-bold text-blue-600 mb-8">📚 Library</h1>

    <ul class="space-y-4">
        <li>
            <a href="{{ route('visitor.dashboard') }}" class="text-gray-700 hover:text-blue-600">
                🏠 Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('visitor.books') }}" class="text-gray-700 hover:text-blue-600">
                📖 Browse Books
            </a>
        </li>
        <li>
            <a href="" class="text-gray-700 hover:text-blue-600">
                👤 Profile
            </a>
        </li>
        <li>
            <button wire:click="logout" class="text-red-600 hover:underline">
                🔒 Logout
            </button>
        </li>
    </ul>
</nav>
