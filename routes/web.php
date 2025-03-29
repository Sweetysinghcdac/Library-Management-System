<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardRedirectController;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Visitor\Dashboard as VisitorDashboard;
use App\Livewire\Visitor\BookBrowse as BookBrowse;
use App\Http\Controllers\Visitor\ExportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Route::get('/redirect-dashboard', DashboardRedirectController::class)
// ->middleware(['auth', 'verified']);

Route::get('/admin/dashboard', AdminDashboard::class)
->middleware('role:admin')
->name('admin.dashboard');

// Visitor route with role check
Route::get('/visitor/dashboard', VisitorDashboard::class)
->middleware('role:visitor')
->name('visitor.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/books', \App\Livewire\Admin\BookManager::class)->name('admin.books');
        Route::get('/reports', \App\Livewire\Admin\Reports::class)->name('admin.reports');
    });

    Route::middleware('role:visitor')->prefix('visitor')->group(function () {
        // Route::get('/books', \App\Livewire\Visitor\BookList::class)->name('visitor.books');
        Route::get('/borrow/{book}', \App\Livewire\Visitor\BookBorrow::class)->name('visitor.borrow');
        Route::get('/books', \App\Livewire\Visitor\BookBrowse::class)->name('visitor.books');
        Route::get('/bookings/export/pdf', [ExportController::class, 'pdf'])->name('visitor.export.pdf');
        Route::get('/bookings/export/csv', [ExportController::class, 'csv'])->name('visitor.export.csv');
        Route::post('/visitor/notifications/read-all', function () {
            auth()->user()->unreadNotifications->markAsRead();
            return back();
        })->name('visitor.notifications.readAll');
    });
});

require __DIR__.'/auth.php';
