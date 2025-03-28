<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow p-4 flex justify-between">
        <h1 class="text-xl font-bold text-blue-600">Library System</h1>
        <div>
            <a href="/visitor/books" class="mr-4 text-gray-700">Books</a>
            <form method="POST" action="/logout" class="inline">@csrf<button class="text-red-500">Logout</button></form>
        </div>
    </nav>
    <main class="p-6">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>