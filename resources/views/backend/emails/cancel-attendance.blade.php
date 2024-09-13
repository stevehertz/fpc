<!DOCTYPE html>
<html>
<head>
    <title>Attendance Cancelled</title>
</head>
<body>
    <h1>Attendance Cancellation</h1>
    <p>Hello {{ $attendance->first_name }} {{ $attendance->last_name }},</p>

    <p>We regret to inform you that your attendance for the event "{{ $attendance->event->name }}" has been cancelled.</p>

    <p><strong>Reason for Cancellation:</strong></p>
    <p>{{ $data['reasons'] }}</p>

    <p>Thank you for your understanding.</p>

    <p>Best regards,</p>
</body>
</html>
