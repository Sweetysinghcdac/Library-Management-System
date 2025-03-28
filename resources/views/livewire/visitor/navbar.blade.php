{{-- resources/views/livewire/visitor/navbar.blade.php --}}
<nav class="bg-white shadow-md h-screen w-64 p-6 flex flex-col justify-between">
    <div>
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
                <a href="{{ route('profile') }}" class="text-gray-700 hover:text-blue-600">
                    👤 Profile
                </a>
            </li>

            {{-- 🔔 Notification Dropdown --}}
            <li x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                    🔔 Notifications
                    @if(auth()->user()->unreadNotifications->count())
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </button>

                {{-- Dropdown Panel --}}
                <div x-show="open" @click.outside="open = false" class="absolute left-40 top-0 mt-2 w-72 bg-white shadow-md border rounded-lg z-50">
                    <div class="p-3 border-b font-semibold text-sm text-gray-700">Recent Notifications</div>
                    <ul class="max-h-60 overflow-y-auto text-sm">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li class="px-4 py-2 border-b hover:bg-gray-50">
                                <a href="{{ $notification->data['url'] }}">
                                    {{ $notification->data['message'] }}
                                </a>
                            </li>
                        @empty
                            <li class="px-4 py-2 text-gray-500 text-center">No new notifications</li>
                        @endforelse
                    </ul>
                    <div class="text-center py-2">
                        <form method="POST" action="{{ route('visitor.notifications.readAll') }}">
                            @csrf
                            <button class="text-xs text-blue-500 hover:underline">Mark all as read</button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    {{-- 🔓 Logout --}}
    <div>
        <button wire:click="logout" class="text-red-600 hover:underline">
            🔒 Logout
        </button>
    </div>
</nav>
