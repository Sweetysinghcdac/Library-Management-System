<!DOCTYPE html>
<html>
<head>
    <title>Borrowed Books Report</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Borrowed Books Report</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Borrowed At</th>
                <th>Due Date</th>
                <th>Returned At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->book->title }}</td>
                    <td>{{ $booking->borrowed_at }}</td>
                    <td>{{ $booking->due_date }}</td>
                    <td>{{ $booking->returned_at ?? 'Not Returned' }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
