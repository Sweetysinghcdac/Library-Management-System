<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use App\Models\Book;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookBorrow extends Component
{
    public $book;

    public function mount(Book $book)
    {
        $this->book = $book;
    }

    public function borrow()
    {
        if ($this->book->stock < 1) {
            session()->flash('error', 'No stock available.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'book_id' => $this->book->id,
            'borrowed_at' => Carbon::now(),
            'return_by' => Carbon::now()->addDays(7),
        ]);

        $this->book->decrement('stock');
        $this->book->increment('borrowed');

        session()->flash('success', 'Book borrowed successfully!');
    }

    public function render()
    {
        return view('livewire.visitor.book-borrow')
            ->layout('layouts.visitor');
    }
}
