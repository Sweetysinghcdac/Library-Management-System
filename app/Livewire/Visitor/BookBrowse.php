<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use App\Models\Book;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Carbon\Carbon;

class BookBrowse extends Component
{
    use WithPagination;

    public $statusFilter = '';

    public $search = '';
    public $perPage = 9;
    public $successMessage = '';
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function reserve($bookId)

    {
        $book = Book::findOrFail($bookId);

        if ($book->stock < 1) {
            $this->addError('stock', 'This book is currently out of stock.');
            return;
        }

        Booking::create([
            'user_id' => Auth::id(),
            'book_id' => $bookId,
            'borrowed_at' => Carbon::now(),
            'due_date' => Carbon::now()->addDays(7),
        ]);

        $book->decrement('stock');

        $this->successMessage = "You've successfully booked '{$book->title}'. Please return it on time.";
    }

    public function render()
    {
        $books = Book::where(function ($query) {
            $query->where('title', 'like', "%{$this->search}%")
                ->orWhere('author', 'like', "%{$this->search}%")
                ->orWhere('category', 'like', "%{$this->search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate($this->perPage);

        return view('livewire.visitor.book-browse', compact('books'))
            ->layout('layouts.visitor');
    }
}
