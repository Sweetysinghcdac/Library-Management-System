<?php

namespace App\Livewire\Visitor;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
class Dashboard extends Component
{
    use WithPagination;

    public $statusFilter = 'all';
    public $fromDate = null;
    public $toDate = null;  

    protected $queryString = ['statusFilter', 'fromDate', 'toDate'];
  

    public function updatingStatusFilter()
    {
        $this->resetPage(); 
    }

    public function updatingFromDate()
    {
        $this->resetPage();
    }

    public function updatingToDate()
    {
        $this->resetPage();
    }


    public function markAsReturned($bookingId)
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->whereNull('returned_at')
            ->first();

        if ($booking) {
            $booking->update([
                'returned_at' => now(),
                'status' => 'returned',
            ]);

            $booking->book->increment('stock');

            session()->flash('message', '✅ Book marked as returned successfully.');
        } else {
            session()->flash('error', '⚠️ Book could not be returned.');
        }
    }
    public function loadBookings()
{
    // No operation; this just ensures Livewire has an AJAX-aware context
}

    public function render()
{
    $query = Booking::with('book')
        ->where('user_id', Auth::id())
        ->latest();
        

    if ($this->statusFilter !== 'all') {
        $query->where('status', $this->statusFilter);
    }

    if ($this->fromDate) {
        $query->whereDate('borrowed_at', '>=', $this->fromDate);
    }

    if ($this->toDate) {
        $query->whereDate('borrowed_at', '<=', $this->toDate);
    }

    $bookings = $query->paginate(6);

    return view('livewire.visitor.dashboard', compact('bookings'))
        ->layout('layouts.visitor');
}

}

