<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100">
    <div class="flex">
        {{-- ✅ Livewire Sidebar --}}
        <livewire:visitor.navbar />

        {{-- ✅ Main Content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>
