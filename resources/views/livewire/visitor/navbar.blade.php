<div x-data="{ openSidebar: false }" class="md:block">

    <!-- Mobile Topbar -->
    <div class="md:hidden flex items-center justify-between bg-white p-4 shadow">
        <h1 class="text-lg font-bold text-blue-600">📚 Library</h1>
        <button @click="openSidebar = !openSidebar" class="text-gray-700 focus:outline-none">
            <svg x-show="!openSidebar" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="openSidebar" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <nav :class="{'block': openSidebar, 'hidden': !openSidebar}" class="md:block bg-white w-full md:w-64 h-auto md:h-screen p-6 shadow-md z-50">
        <div class="flex flex-col justify-between h-full">
            <div>
                <h1 class="text-xl font-bold text-blue-600 mb-8 hidden md:block">📚 Library</h1>

                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('visitor.dashboard') }}" class="text-gray-700 hover:text-blue-600 block">
                            🏠 Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('visitor.books') }}" class="text-gray-700 hover:text-blue-600 block">
                            📖 Browse Books
                        </a>
                    </li>
                   
                    <!-- Notification Dropdown -->
                    <li x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-blue-600">
                            🔔 Notifications
                            @if(auth()->user()->unreadNotifications->count())
                                <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <div x-show="open" @click.outside="open = false"
                             class="absolute left-0 top-full mt-2 w-72 bg-white shadow-md border rounded-lg z-50">
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

            <!-- Livewire Logout Button -->
            <div class="mt-6">
                <button type="button" wire:click="logout" class="text-red-600 hover:underline">
                    🔒 Logout
                </button>
            </div>
        </div>
    </nav>
</div>
<script>
    Livewire.on('notify', data => {
        alert(data.message); // Replace with toast if you like
    });
</script>
