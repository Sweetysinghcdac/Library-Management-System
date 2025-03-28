<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use App\Models\Book;

class BookList extends Component
{
    public $books;

    public function mount()
    {
        $this->books = Book::latest()->get();
    }

    public function render()
    {
        return view('livewire.visitor.book-list')
            ->layout('layouts.visitor');
    }
}
