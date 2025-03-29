<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-b from-white via-blue-50 to-blue-100 text-gray-800 font-sans">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-6 py-4 bg-white shadow-md sticky top-0 z-50">
        <h1 class="text-2xl font-bold text-blue-600">📚 MyLibrary</h1>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login</a>
            <a href="{{ route('register') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                Register
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex flex-col-reverse md:flex-row items-center justify-between max-w-7xl mx-auto px-6 py-20">
        <div class="w-full md:w-1/2 space-y-6">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                Manage Your Library <br>
                <span class="text-blue-600">Smarter, Not Harder</span>
            </h2>
            <p class="text-lg text-gray-600">
                Empower admins and visitors with an intuitive, fast, and scalable system to manage books, borrowing, and reports.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-blue-600 text-white rounded-lg font-semibold shadow hover:bg-blue-700 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-3 bg-white border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                    Register as Visitor
                </a>
            </div>
        </div>
        <div class="w-full md:w-1/2 mb-12 md:mb-0">
            <img src="https://img.freepik.com/free-vector/online-library-concept-with-reading-people-electronic-devices-book-shelves-3d-isometric_1284-31703.jpg?t=st=1743239874~exp=1743243474~hmac=dd8d7a7cf114a2d49fd8f80a0f2f18e3e58a2da4b7b066b367f4ebdcbc3ec130&w=900"
                 alt="Library Illustration"
                 class="w-full max-w-md mx-auto">
        </div>
    </section>

    <!-- About -->
    <section class="bg-white py-16 px-6 text-center">
        <h3 class="text-3xl font-bold text-gray-800 mb-4">About Our System</h3>
        <p class="text-gray-600 max-w-2xl mx-auto text-lg">
            Our Library Management System is built using Laravel, Livewire, and Tailwind CSS, offering powerful features for both admins and visitors to keep the library organized, accessible, and efficient.
        </p>
    </section>

    <!-- Features -->
    <section class="py-16 bg-blue-50 px-6">
        <h3 class="text-3xl font-bold text-center text-gray-800 mb-10">Key Features</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white rounded-lg p-6 shadow hover:shadow-md transition">
                <h4 class="text-xl font-bold text-blue-600 mb-2">📘 Book Management</h4>
                <p class="text-gray-600">Admins can add, edit, and manage book stock efficiently with real-time Livewire components.</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow hover:shadow-md transition">
                <h4 class="text-xl font-bold text-blue-600 mb-2">📤 Borrow & Return</h4>
                <p class="text-gray-600">Visitors can borrow books and return them easily. Admins track and control lending activities.</p>
            </div>
            <div class="bg-white rounded-lg p-6 shadow hover:shadow-md transition">
                <h4 class="text-xl font-bold text-blue-600 mb-2">📊 Reports & Insights</h4>
                <p class="text-gray-600">Generate reports of top readers and most-read books with beautiful dashboards and metrics.</p>
            </div>
        </div>
    </section>

    <!-- Roles Section -->
    <section class="py-16 px-6 max-w-6xl mx-auto">
        <h3 class="text-3xl font-bold text-center text-gray-800 mb-10">Who Can Use This?</h3>
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg p-6 shadow border-l-4 border-blue-500">
                <h4 class="text-2xl font-semibold mb-2 text-blue-600">🧑‍💼 Admin Panel</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>Manage books and categories</li>
                    <li>Track borrowing and returns</li>
                    <li>Generate top reader/book reports</li>
                    <li>Secure role-based access</li>
                </ul>
            </div>
            <div class="bg-white rounded-lg p-6 shadow border-l-4 border-green-500">
                <h4 class="text-2xl font-semibold mb-2 text-green-600">📚 Visitor Access</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>Browse books and availability</li>
                    <li>Request to borrow books</li>
                    <li>View their own borrowing history</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-16 text-center px-6">
        <h3 class="text-3xl md:text-4xl font-extrabold mb-4">Ready to manage your library smartly?</h3>
        <p class="text-lg mb-6">Sign up now and start borrowing or managing books easily.</p>
        <a href="{{ route('register') }}"
           class="bg-white text-blue-700 font-bold px-8 py-3 rounded-lg shadow hover:bg-gray-100 transition">
            Register Today
        </a>
    </section>

    <!-- Footer -->
    <footer class="text-center py-6 text-gray-500 text-sm border-t mt-6">
        © {{ date('Y') }} MyLibrary. All rights reserved.
    </footer>

</body>
</html>
