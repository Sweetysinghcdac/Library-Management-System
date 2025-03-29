<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    
    {{-- Tailwind & Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire Styles --}}
    @livewireStyles
</head>
<body class="bg-gray-100 overflow-x-hidden min-h-screen antialiased text-gray-800">
    <div class="flex flex-col md:flex-row min-h-screen">
        
        {{-- ✅ Responsive Sidebar --}}
        <aside class="w-full md:w-64 bg-white shadow-md z-10">
            <livewire:visitor.navbar />
        </aside>

        {{-- ✅ Main Content Area --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8 overflow-x-hidden ">
            {{ $slot }}
        </main>
    </div>

    {{-- Livewire Scripts --}}
    @livewireScripts

    {{-- Alpine.js for interactivity --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
