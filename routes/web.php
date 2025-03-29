<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\Visitor\ExportController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ReportExportController;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\BookManager;
use App\Livewire\Admin\Reports;
use App\Livewire\Admin\BorrowedBooks;
use App\Livewire\Visitor\Dashboard as VisitorDashboard;
use App\Livewire\Visitor\BookBrowse;
use App\Livewire\Visitor\BookBorrow;


Route::view('/', 'welcome');

// Profile
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Admin Routes
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/books', BookManager::class)->name('books');
    Route::get('/books/data', [BookController::class, 'data'])->name('books.data');
    Route::get('/borrowed-books', BorrowedBooks::class)->name('borrowed-books');
    Route::get('/reports', Reports::class)->name('reports');
    Route::get('/reports/export/{type}/{format}', [ReportExportController::class, 'export'])->name('reports.export');
});

// Visitor Routes
Route::middleware(['auth', 'verified', 'role:visitor'])->prefix('visitor')->name('visitor.')->group(function () {
    Route::get('/dashboard', VisitorDashboard::class)->name('dashboard');
    Route::get('/books', BookBrowse::class)->name('books');
    Route::get('/borrow/{book}', BookBorrow::class)->name('borrow');
    
    // Export
    Route::get('/bookings/export/pdf', [ExportController::class, 'pdf'])->name('export.pdf');
    Route::get('/bookings/export/csv', [ExportController::class, 'csv'])->name('export.csv');

    // Notifications
    Route::post('/notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
});

require __DIR__.'/auth.php';
