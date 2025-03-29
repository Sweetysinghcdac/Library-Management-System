<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Booking;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReturnBookReminder;

class BorrowedBooks extends Component
{
    use WithPagination;

    public $search = '';
    public $searchTrigger = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function applySearch()
    {
        $this->searchTrigger = $this->search;
        $this->resetPage();
    }

    public function sendReminder($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
    
        if ($booking->status === 'returned') {
            $this->dispatch('notify', [
                'type' => 'info',
                'message' => 'Book already returned.'
            ]);
            return;
        }
    
        $booking->user->notify(new ReturnBookReminder($booking));
    
        $this->dispatch('swal:success', [
            'title' => 'Success',
            'text' => 'Book deleted successfully!',
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
            ->orderByDesc('borrowed_at')
            ->paginate(6);

        return view('livewire.admin.borrowed-books', compact('bookings'))
            ->layout('layouts.admin');
    }
}
