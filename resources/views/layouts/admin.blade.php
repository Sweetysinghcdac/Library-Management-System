<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <div class="flex">
        <aside class="w-64 h-screen bg-white shadow-md p-4">
            <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
            <ul class="space-y-4">
                <li><a href="/admin/books" class="text-blue-600">Manage Books</a></li>
                <li><a href="/admin/reports" class="text-blue-600">Reports</a></li>
                <li><form method="POST" action="/logout">@csrf<button class="text-red-500">Logout</button></form></li>
            </ul>
        </aside>
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>