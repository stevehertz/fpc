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
        Dear {{ $attendance->first_name }},
    </p>

    <p>
        Thank you for registering for the event. Attached is your QR code for attendance confirmation
    </p>

    <p>Please show this QR code at the event to confirm your attendance and receive your pass</p>

    <p>Thank you!</p>
</body>

</html>
