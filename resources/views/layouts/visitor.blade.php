<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">

    {{-- ✅ Livewire Navbar --}}
    <livewire:navbar />

    <main class="p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
