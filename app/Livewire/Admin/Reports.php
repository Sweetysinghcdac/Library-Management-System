<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\User;

class Reports extends Component
{
    public $topBooks, $topReaders;

    public function mount()
    {
        $this->topBooks = Book::orderByDesc('borrowed')->take(10)->get();
        $this->topReaders = User::withCount('bookings')->orderByDesc('bookings_count')->take(10)->get();
    }

    public function render()
    {
        return view('livewire.admin.reports')
            ->layout('layouts.admin');
    }
}
