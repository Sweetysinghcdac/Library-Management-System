<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use App\Models\Book;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookBrowse extends Component
{
    // public $search = '';
    // public $selectedBook = null;
    // public $showModal = false;
    // public $alreadyBooked = false;

    // public function updatedSearch()
    // {
    //     $this->reset('selectedBook', 'showModal', 'alreadyBooked');
    // }

    // public function selectBook($bookId)
    // {
    //     $this->selectedBook = Book::findOrFail($bookId);
    //     $this->alreadyBooked = Booking::where('book_id', $bookId)
    //         ->where('user_id', Auth::id())
    //         ->whereNull('returned_at')
    //         ->exists();
    //     $this->showModal = true;
    // }

    // public function bookSelectedBook()
    // {
    //     if (!$this->selectedBook || $this->alreadyBooked) return;

    //     Booking::create([
    //         'user_id' => Auth::id(),
    //         'book_id' => $this->selectedBook->id,
    //         'borrowed_at' => Carbon::today(),
    //         'due_date' => Carbon::today()->addDays(7),
    //         'status' => 'pending',
    //     ]);

    //     $this->dispatchBrowserEvent('close-modal');
    //     session()->flash('message', 'Book reserved successfully!');
    //     $this->reset('selectedBook', 'showModal', 'alreadyBooked');
    // }

    // public function render()
    // {
    //     $books = Book::query()
    //         ->where('title', 'like', "%{$this->search}%")
    //         ->orWhere('author', 'like', "%{$this->search}%")
    //         ->orWhere('category', 'like', "%{$this->search}%")
    //         ->get();

    //     return view('livewire.visitor.book-browse', [
    //         'books' => $books,
    //     ]);
    // }
    
    public $search = '';
    public $books;

    public function mount()
    {
        $this->books = Book::all();
    }

    public function updatedSearch()
    {
        $this->books = Book::where('title', 'like', "%{$this->search}%")
            ->orWhere('author', 'like', "%{$this->search}%")
            ->orWhere('category', 'like', "%{$this->search}%")
            ->get();
    }

    public function bookNow($bookId)
    {
        $book = Book::findOrFail($bookId);

        if ($book->stock < 1) {
            session()->flash('error', 'Book is currently unavailable.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'borrowed_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(7),
            'status' => 'pending',
        ]);

        $book->decrement('stock');

        session()->flash('message', 'Book successfully booked!');
        $this->books = Book::all();
    }


    public function render()
    {

        return view('livewire.visitor.book-browse',)->layout('layouts.visitor');
    }
}
