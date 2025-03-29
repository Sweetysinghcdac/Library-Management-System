<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Book;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TopBooksExport;
use App\Exports\TopReadersExport;

class Reports extends Component
{
    public $view = 'books'; // default view

    public function showBooks()
    {
        $this->view = 'books';
    }

    public function showReaders()
    {
        $this->view = 'readers';
    }

    public function exportExcel()
    {
        return $this->view === 'books'
            ? Excel::download(new TopBooksExport, 'top-10-books.xlsx')
            : Excel::download(new TopReadersExport, 'top-10-readers.xlsx');
    }

    public function exportPDF()
    {
        $data = $this->view === 'books'
            ? Book::withCount('bookings')->orderByDesc('bookings_count')->take(10)->get()
            : User::withCount('bookings')->orderByDesc('bookings_count')->take(10)->get();

        $pdf = Pdf::loadView('exports.' . $this->view, ['data' => $data]);

        return response()->streamDownload(fn () => print($pdf->output()), $this->view === 'books' ? 'top-10-books.pdf' : 'top-10-readers.pdf');
    }

    public function render()
    {
        $topBooks = Book::withCount('bookings')->orderByDesc('bookings_count')->take(10)->get();
        $topReaders = User::withCount('bookings')->orderByDesc('bookings_count')->take(10)->get();

        return view('livewire.admin.reports', compact('topBooks', 'topReaders'))
            ->layout('layouts.admin');
    }
}
