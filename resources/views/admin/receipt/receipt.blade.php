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
            background-color: #f8f9fa;
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
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
            <p><strong>Time:</strong> 6:20pm</p>
            <p><strong>Travels Name:</strong>Maharastra Shasan</p>
            <p><strong>Bus Type:</strong>Luxury</p>
            <p><strong>Gender:</strong>Male</p>
            <p><strong>Contact Number:</strong>902332****</p>
            <p class="total-amount"><strong>Amount Paid:</strong> ₹500</p>
        </div>
    </div>
    <button class="download-btn" onclick="downloadPDF()">📥 Download PDF</button>
    <script>
        function downloadPDF() {
            window.location.href = "/download-receipt"; // This calls the route
        }
    </script>
</body>
</html>
