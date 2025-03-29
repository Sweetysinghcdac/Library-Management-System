<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 " >
    <!-- Responsive wrapper -->
    <div x-data="{ open: false }" class="min-h-screen flex flex-col md:flex-row">
        <!-- Mobile Topbar -->
        <header class="bg-white shadow md:hidden flex justify-between items-center px-4 py-3">
            <h1 class="text-lg font-bold text-blue-600">Admin Panel</h1>
            <button @click="open = !open" class="text-gray-700 focus:outline-none">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </header>

        <!-- Sidebar -->
        <aside :class="{'block': open, 'hidden': !open}" class="md:block bg-white w-full md:w-64 h-auto md:h-screen shadow-md p-6 md:p-4">
            <livewire:admin.admin-navbar />
        </aside>

        <!-- Main Content -->
        <main class="flex-1  sm:p-6 lg:px-8 overflow-x-hidden">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
</body>
</html>