<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Livewire\WithPagination;
use App\Models\Book;
class Dashboard extends Component
{
    use WithPagination;

    public $statusFilter = 'all';

    protected $queryString = ['statusFilter']; // ✅ Track in URL
    public $fromDate;
    public $toDate;

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

