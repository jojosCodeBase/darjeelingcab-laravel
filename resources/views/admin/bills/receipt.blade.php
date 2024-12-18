<!DOCTYPE html>
<html>

<head>
    <title>Receipt - {{ $receipt_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .logo {
            float: left;
            width: 150px;
        }

        .header .info {
            float: right;
            text-align: right;
            width: calc(100% - 160px);
        }

        .header .info p {
            font-size: 16px;
            margin: 5px 0;
        }

        .container .receipt-heading {
            font-size: 28px;
            color: #FF6224;
            margin-bottom: 20px;
            text-align: center;
        }

        .details {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .details h2 {
            font-size: 22px;
            color: #FF6224;
            margin: 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #FF6224;
        }

        .details p {
            margin: 5px 0;
            font-size: 16px;
        }

        .details .info {
            display: flex;
            justify-content: space-between;
        }

        .details .info div {
            width: 48%;
        }

        .table-container {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-container th {
            background-color: #FF6224;
            color: #fff;
            font-weight: bold;
        }

        .table-container tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .summary {
            margin-top: 20px;
            font-size: 16px;
            text-align: right;
        }

        .summary p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer .highlight {
            color: #FF6224;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="https://www.darjeelingcab.in/assets/images/white-logo.png" alt="Darjeeling Cab Logo" style="width: 150px;">
            </div>
            <div class="info">
                <p><strong>Receipt Number:</strong> {{ $receipt_no }}</p>
                <p><strong>Invoice Number:</strong> {{ $bill_no }}</p>
                <p><strong>Date:</strong> {{ $payment_date }}</p>
            </div>
        </div>

        <h1 class="receipt-heading">Receipt</h1>

        <!-- Receipt and Customer Details -->
        <div class="details">
            <h2>Customer Details</h2>
            <div class="info">
                <div>
                    <p><strong>Name:</strong> {{ $name }}</p>
                    <p><strong>Customer Type:</strong> {{ $customer_type }}</p>
                    <p><strong>Phone:</strong> {{ $phone_no }}</p>
                    <p><strong>Email:</strong> {{ $email }}</p>
                    <p><strong>Address:</strong> {{ $address }}</p>
                </div>
                <div>
                    <h2>Payment Details</h2>
                    <p><strong>Payment Method:</strong> {{ $payment_method }}</p>
                    <p><strong>Amount:</strong> ₹{{ $amount }}</p>
                    <p><strong>Balance:</strong> ₹{{ $balance }}</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Note:</strong> This is a system-generated receipt and does not require a physical signature.</p>
            <p class="highlight">info@darjeelingcab.in | 9339342603/8967386612 | www.darjeelingcab.in | Peshok, Peshok Tea Garden, Rangli Rangliot, Darjeeling - 734312, West Bengal, IN</p>
            <p class="highlight">Thank you for choosing Darjeeling Cab. We hope to serve you again!</p>
        </div>
    </div>
</body>

</html>
