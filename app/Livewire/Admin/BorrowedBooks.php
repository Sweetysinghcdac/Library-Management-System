<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReturnBookReminder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BorrowedBooks extends Component
{
    use WithPagination;

    public $search = '';
    public $searchTrigger = '';
    public $statusFilter = '';

    public $showModal = false;
    public $editingBookingId;
    public $newDueDate;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function applySearch()
    {
        $this->searchTrigger = $this->search;
        $this->resetPage();
    }

    public function showDueDateModal($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $this->editingBookingId = $bookingId;
        $this->newDueDate = $booking->due_date ? Carbon::parse($booking->due_date)->format('Y-m-d') : now()->addDays(7)->format('Y-m-d');
        $this->showModal = true;
    }

    public function updateDueDate()
    {
        $this->validate([
            'newDueDate' => 'required|date|after_or_equal:today',
        ]);

        $booking = Booking::findOrFail($this->editingBookingId);
        $booking->due_date = $this->newDueDate;
        $booking->save();

        $this->showModal = false;
        $this->dispatch('swal:success', [
            'title' => 'Updated!',
            'text' => 'Due date updated successfully.'
        ]);
    }

    public function sendReminder($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->status === 'returned') {
            $this->dispatch('swal:error', [
                'title' => 'Already Returned',
                'text' => 'This book is already marked as returned.'
            ]);
            return;
        }

        $booking->user->notify(new ReturnBookReminder($booking));

        $this->dispatch('swal:success', [
            'title' => 'Success',
            'text' => 'Reminder sent successfully.'
        ]);
    }

    public function render()
    {
        $bookings = Booking::with(['user', 'book'])
            ->when($this->searchTrigger, function ($query) {
                $query->whereHas('book', function ($q) {
                    $q->where('title', 'like', '%' . $this->searchTrigger . '%');
                })->orWhereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchTrigger . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->orderByDesc('borrowed_at')
            ->paginate(6);

        return view('livewire.admin.borrowed-books', compact('bookings'))
            ->layout('layouts.admin');
    }
}
