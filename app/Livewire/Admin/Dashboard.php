<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $bookCount;
    public $borrowedCount;
    public $readerCount;
    public $overdueBookings;

    public function mount()
    {
        $this->bookCount = Book::count();
        $this->borrowedCount = Booking::whereNull('returned_at')->count();
        $this->readerCount = Booking::distinct('user_id')->count();

        $this->overdueBookings = Booking::with(['user', 'book'])
            ->whereNull('returned_at')
            ->whereDate('due_date', '<', Carbon::today())
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin');
    }
}
