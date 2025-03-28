<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;

class BookManager extends Component
{
    public $books, $title, $author, $category, $description, $stock, $bookId;
    public $isEdit = false;
    public function render()
    {
        $this->books = Book::latest()->get();
        return view('livewire.admin.book-manager')
            ->layout('layouts.admin');
    }
    public function resetInput()
    {
        $this->title = $this->author = $this->category = $this->description = $this->stock = '';
        $this->bookId = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'stock' => 'required|integer|min:1',
        ]);

        Book::updateOrCreate(
            ['id' => $this->bookId],
            [
                'title' => $this->title,
                'author' => $this->author,
                'category' => $this->category,
                'description' => $this->description,
                'stock' => $this->stock,
            ]
        );

        session()->flash('message', $this->bookId ? 'Book updated.' : 'Book created.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->bookId = $book->id;
        $this->title = $book->title;
        $this->author = $book->author;
        $this->category = $book->category;
        $this->description = $book->description;
        $this->stock = $book->stock;
        $this->isEdit = true;
    }

    public function delete($id)
    {
        Book::destroy($id);
        session()->flash('message', 'Book deleted.');
    }
}
