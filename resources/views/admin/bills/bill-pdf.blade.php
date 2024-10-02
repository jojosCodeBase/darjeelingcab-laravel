<!DOCTYPE html>
<html>

<head>
    <title>Invoice - {{ $bill->bill_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 100%;
            margin: auto;
            padding: 20px;
        }

        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #FF6224; /* Brand color for border */
            padding-bottom: 10px;
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

        .header .info h1 {
            font-size: 24px;
            margin: 5px 0;
            color: #FF6224; /* Brand color for heading */
        }

        .header .info p {
            margin: 5px 0;
            font-size: 16px;
        }

        .header .company-details {
            text-align: center;
            margin-top: 10px;
        }

        .header .company-details p {
            margin: 5px 0;
            font-size: 14px;
        }

        .header::after {
            content: "";
            display: table;
            clear: both;
        }

        .table-container {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table-container th {
            background-color: #FF6224; /* Brand color for header background */
            color: #fff; /* White text for contrast */
            font-weight: bold;
            padding: 12px;
        }

        .table-container td {
            padding: 12px;
        }

        .table-container tr:nth-child(even) {
            background-color: #f9f9f9; /* Light grey for alternating rows */
        }

        .content {
            margin-top: 20px;
        }

        .content h2 {
            font-size: 18px;
            border-bottom: 2px solid #FF6224; /* Brand color for border */
            padding-bottom: 10px;
            margin: 0;
            color: #FF6224; /* Brand color for heading */
        }

        .summary {
            margin-top: 20px;
            font-size: 16px;
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
            color: #FF6224; /* Brand color for highlights */
        }

        .note {
            font-size: 14px;
            color: #555;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <div class="logo">
                <img src="https://darjeelingcab.in/assets/images/white-logo.png" alt="Darjeeling Cab Logo" style="width: 150px;">
            </div>
            <div class="info">
                <h1>Darjeeling Cab</h1>
                <p>Your Journey, Our Priority</p>
                <p><strong>Invoice Number:</strong> {{ $bill->bill_no }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($bill->bill_date)->format('d M, Y') }}</p>
            </div>
        </div>

        <!-- Invoice and Customer Details Table -->
        <table class="table-container">
            <tr>
                <td style="width: 60%;">
                    <strong><span style="padding: 10px; color: #FF6224;">Bill To</span></strong><br>
                    {{ $customer->full_name }} ({{ $customer->customer_type }})<br>
                    {{ $customer->phone_no }}<br>
                    {{ $customer->address }}<br>
                </td>
                <td style="width: 40%;">
                    <h3 style="color: #FF6224;">Other Details</h3>
                    <p style="margin-bottom: 20px;">Payment Status: {{ $payment_status }}</p>
                    <p style="margin-bottom: 20px;">Vehicle Details: {{ $vehicle_details }}</p>
                </td>
            </tr>
        </table>

        <!-- Invoice Items Table -->
        <div class="content">
            <h2>Invoice Items</h2>
            <table class="table-container">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Item Description</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dates as $index => $date)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $description[$index] }}<br>
                                Date: {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}
                            </td>
                            <td>₹{{ $amounts[$index] }}</td>
                            <td>1</td>
                            <td>₹{{ $amounts[$index] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="summary">
                <p><strong>Subtotal:</strong> ₹{{ $bill->sub_total }}</p>
                <p><strong>Discount:</strong> ₹{{ $bill->discount }}</p>
                <p><strong>Total Amount:</strong> ₹{{ $bill->total_amount }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Note:</strong> This is a system-generated invoice and does not require a physical signature.</p>
            <p class="highlight">info@darjeelingcab.in | 8967386612/7478459652 | www.darjeelingcab.in | Peshok, Peshok Tea Garden, Rangli Rangliot, Darjeeling - 734312, West Bengal, IN</p>
            <p class="highlight">Thank you for choosing Darjeeling Cab.</p>
        </div>
    </div>
</body>

</html>
