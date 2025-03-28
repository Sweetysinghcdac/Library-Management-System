<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="flex">
        {{-- ✅ Livewire Sidebar --}}
        <livewire:admin.admin-navbar />

        {{-- ✅ Main Content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>
