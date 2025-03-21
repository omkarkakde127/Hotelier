<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #fff;
            margin: 0;
            padding: 20px;
        }
        .receipt-container {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            width: 80%;
            max-width: 500px;
            margin: auto;
        }
        .receipt-header {
            background: #007bff;
            color: #fff;
            padding: 10px;
        }
        .receipt-details {
            text-align: left;
            margin-top: 20px;
        }
        .receipt-details p {
            border-bottom: 1px dashed #ddd;
            padding-bottom: 5px;
        }
        .total-amount {
            font-size: 1.4rem;
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <div class="receipt-header">
            <h2>Bus Ticket Receipt</h2>
        </div>
        <div class="receipt-details">
            <p><strong>Booking ID:</strong> 12345</p>
            <p><strong>Passenger Name:</strong> John Doe</p>
            <p><strong>From:</strong> City A</p>
            <p><strong>To:</strong> City B</p>
            <p><strong>Journey Date:</strong> 25 Feb 2025</p>
            <p><strong>Seats:</strong> 2</p>
            <p class="total-amount"><strong>Amount Paid:</strong> ₹500</p>
        </div>
    </div>
</body>
</html>
