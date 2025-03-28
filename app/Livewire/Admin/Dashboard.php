<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\Booking;
use App\Models\User;

class Dashboard extends Component
{
    public $bookCount;
    public $borrowedCount;
    public $readerCount;

    public function mount()
    {
        $this->bookCount = Book::count();
        $this->borrowedCount = Booking::whereNotNull('returned_at')->count();
        $this->readerCount = User::where('role', 'visitor')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin');
    }
}
