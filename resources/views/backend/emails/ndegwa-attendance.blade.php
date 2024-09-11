<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance QR Code</title>
</head>
<body>
    <p>
        Dear Edwin,
    </p>

    <p>
        Attendance for {{ $attendance->first_name }} {{ $attendance->last_name }} has been confirmed. Below are the details:
    </p>

    <p>
        <strong>Full Names</strong>: {{ $attendance->first_name }} {{ $attendance->last_name }}
    </p>

    <p>
        <strong>Phone Number</strong>: {{ $attendance->phone }}
    </p>

    <p>
        <strong>Email</strong>: {{ $attendance->email }}
    </p>

    <p>
        <strong>Organization</strong>: {{ $attendance->organization }}
    </p>

    <p>
        <strong>Designation</strong>: {{ \DelegatesPosition::getName($attendance->position) }}
    </p>

    <p>Below is the QR Code attached</p>

    <p>Thank you!</p>
</body>
</html>