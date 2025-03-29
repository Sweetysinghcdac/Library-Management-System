<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportExportController extends Controller
{
    public function export($type, $format)
    {
        if ($type === 'books') {
            $data = Book::withCount('bookings')->orderByDesc('bookings_count')->take(10)->get();
            $view = 'exports.books';
            $filename = 'top-10-books';
        } else {
            $data = User::withCount('bookings')->orderByDesc('bookings_count')->take(10)->get();
            $view = 'exports.readers';
            $filename = 'top-10-readers';
        }

        if ($format === 'pdf') {
            $pdf = Pdf::loadView($view, ['data' => $data]);
            return $pdf->download($filename . '.pdf');
        }

        if ($format === 'csv') {
            $csv = $data->map(function ($item) use ($type) {
                return $type === 'books'
                    ? [
                        'Title' => $item->title,
                        'Author' => $item->author,
                        'Borrowed Count' => $item->bookings_count
                    ]
                    : [
                        'Name' => $item->name,
                        'Email' => $item->email,
                        'Books Borrowed' => $item->bookings_count
                    ];
            });

            $output = fopen('php://temp', 'r+');
            fputcsv($output, array_keys($csv->first()));
            foreach ($csv as $row) {
                fputcsv($output, $row);
            }

            rewind($output);
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=\"$filename.csv\"",
            ];

            return Response::stream(fn() => fpassthru($output), 200, $headers);
        }

        return abort(404);
    }
}
