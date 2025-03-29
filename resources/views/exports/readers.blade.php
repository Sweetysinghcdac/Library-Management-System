<h2>Top 10 Active Readers</h2>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr><th>#</th><th>Name</th><th>Email</th><th>Books Borrowed</th></tr>
    </thead>
    <tbody>
        @foreach($data as $index => $reader)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $reader->name }}</td>
                <td>{{ $reader->email }}</td>
                <td>{{ $reader->bookings_count }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
