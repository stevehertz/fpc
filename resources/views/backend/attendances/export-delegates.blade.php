<table>
    <thead>
        <tr>
            <th>SN</th>
            <th>Full Names</th>
            <th>Event</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Organization</th>
            <th>Position</th>
            <th>Registered As</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $report)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $report->first_name }} {{ $report->last_name }}</td>
                <td>{{ $report->event->name }}</td>
                <td>{{ $report->phone }}</td>
                <td>{{ $report->email }}</td>
                <td>{{ $report->organization }}</td>
                <td>
                    @if (\ExhibitionRegisterAs::getName($report->user_type) == 'Delegate')
                        {{ \ExhibitionRegisterAs::getName($report->user_type) }}
                    @else
                        {{ $report->position }}
                    @endif
                </td>
                <td>
                    {{ \ExhibitionRegisterAs::getName($report->user_type) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
