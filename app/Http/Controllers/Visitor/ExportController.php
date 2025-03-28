<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use PDF;

class ExportController extends Controller
{
    public function pdf(Request $request)
    {
        $bookings = $this->filteredBookings($request);
        $pdf = PDF::loadView('exports.visitor-bookings-pdf', compact('bookings'));
        return $pdf->download('borrowed_books.pdf');
    }

    public function csv(Request $request)
    {
        $bookings = $this->filteredBookings($request);

        $filename = "borrowed_books.csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($bookings) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Title', 'Borrowed At', 'Due Date', 'Returned At', 'Status']);

            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->book->title,
                    $booking->borrowed_at,
                    $booking->due_date,
                    $booking->returned_at ?? 'Not Returned',
                    ucfirst($booking->status),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function filteredBookings($request)
    {
        return Booking::with('book')
            ->where('user_id', Auth::id())
            ->when($request->status && $request->status !== 'all', fn($q) => $q->where('status', $request->status))
            ->when($request->fromDate, fn($q) => $q->whereDate('borrowed_at', '>=', $request->fromDate))
            ->when($request->toDate, fn($q) => $q->whereDate('borrowed_at', '<=', $request->toDate))
            ->latest()
            ->get();
    }
}
