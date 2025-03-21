<!DOCTYPE html>
<html>

<head>
    <title>Booking Confirmation</title>
</head>

<body>
    <h3>Dear {{ $booking->name }},</h3>
    <p>Thank you for booking with us!</p>
    <p><strong>Check-In:</strong> {{ $booking->check_in }}</p>
    <p><strong>Check-Out:</strong> {{ $booking->check_out }}</p>
    <p><strong>Room:</strong> {{ $booking->room }}</p>
    <b>We are excited to welcome you and look forward to making your experience memorable.</b>
    <p><strong>Address:</strong> xyz Hotelier,<br>
        Nageshwarwadi Nirala Bajar, Near Phule chauk,<br>
        Chh Sambhajinagar 431001, Maharastra,<br>
       <strong> Email; hotelier@gmail.com </strong><br>
        <strong>contact: +91 1234-5678-900 </strong></p>
</body>

</html>