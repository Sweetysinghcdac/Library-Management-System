<?php

namespace App\Livewire\Admin;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Book;

class BookManager extends Component
{
    use WithPagination;

    public $title, $author, $category, $description, $stock, $bookId;
    public $isEdit = false;

    protected $rules = [
        'title' => 'required',
        'author' => 'required',
        'category' => 'required',
        'stock' => 'required|integer|min:1',
    ];

    public function render()
    {
        $books = Book::latest()->paginate(5);
        return view('livewire.admin.book-manager', compact('books'))
            ->layout('layouts.admin');
    }

    public function resetInput()
    {
        $this->title = $this->author = $this->category = $this->description = $this->stock = '';
        $this->bookId = null;
        $this->isEdit = false;
        $this->resetValidation();
    }

    public function store()
{
    $this->validate();

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

    $message = $this->bookId ? 'Book updated successfully!' : 'Book created successfully!';
    $this->dispatch('popupMessage', $message);
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
            $this->dispatch('popupMessage', 'Book deleted successfully!');
        }
    public function updating($field)
    {
        if ($this->isEdit) {
            $this->validateOnly($field);
        }
    }
}
