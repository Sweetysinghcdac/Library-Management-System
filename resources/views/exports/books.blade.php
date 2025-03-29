    <h2>Top 10 Most Read Books</h2>
    <table border="1" cellpadding="5" cellspacing="0" width="100%">
        <thead>
            <tr><th>#</th><th>Title</th><th>Author</th><th>Total Borrowed</th></tr>
        </thead>
        <tbody>
            @foreach($data as $index => $book)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->bookings_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
