<!DOCTYPE html>
<html>

<head>
    <title>Invoice - Darjeeling Cab</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .company-details {
            text-align: right;
        }

        .company-details p {
            margin: 5px 0;
        }

        h1, h2, p {
            margin: 0;
        }

        h1 {
            color: #007bff;
            margin-bottom: 10px;
        }

        .bill-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        .totals {
            margin-top: 20px;
        }

        .totals p {
            margin: 5px 0;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }

        .footer p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://darjeelingcab.in/img/darjeelingcab-logo.png" alt="Darjeeling Cab Logo">
            <div class="company-details">
                <p>Darjeeling Cab</p>
                <p>1234 Cab Street, Darjeeling</p>
                <p>Email: info@darjeelingcab.com</p>
                <p>Phone: (123) 456-7890</p>
            </div>
        </div>

        <h1>Invoice</h1>

        <div class="bill-info">
            <p><strong>Customer:</strong> John Doe</p>
            <p><strong>Invoice Date:</strong> July 3, 2024</p>
            <p><strong>Invoice Number:</strong> #123456</p>
        </div>

        <h2>Service Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Service Type</th>
                    <th>Distance (km)</th>
                    <th>Rate (₹/km)</th>
                    <th>Amount (₹)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Airport Transfer</td>
                    <td>20</td>
                    <td>20</td>
                    <td>400</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>City Tour</td>
                    <td>30</td>
                    <td>15</td>
                    <td>450</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Day Hire</td>
                    <td>50</td>
                    <td>10</td>
                    <td>500</td>
                </tr>
            </tbody>
        </table>

        <div class="totals">
            <p><strong>Sub Total:</strong> ₹1350</p>
            <p><strong>Discount:</strong> ₹50</p>
            <p><strong>Total Amount:</strong> ₹1300</p>
        </div>

        <div class="footer">
            <p>Thank you for choosing Darjeeling Cab.</p>
            <p>Visit us at <a href="https://www.darjeelingcab.in">www.darjeelingcab.in</a></p>
        </div>
    </div>
</body>

</html>
