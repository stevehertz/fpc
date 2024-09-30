<table>
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Organization</th>
            <th>Email Address</th>
            <th>Phone Number</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $report)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->organization }}</td>
                <td>{{ $report->email }}</td>
                <td>{{ $report->phone }}</td>
            </tr>
        @endforeach
    </tbody>
</table>