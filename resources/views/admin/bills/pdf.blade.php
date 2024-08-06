<!DOCTYPE html>
<html>

<head>
    <title>Bill PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header img {
            max-width: 150px;
        }

        .company-details {
            text-align: right;
        }

        .company-details p {
            margin: 0;
        }

        h1, h2, p {
            margin: 0 0 10px 0;
        }

        h1 {
            margin-top: 20px;
        }

        .bill-info {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .totals {
            margin-top: 20px;
        }

        .totals p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://darjeelingcab.in/img/darjeelingcab-logo.png" alt="Company Logo">
            <div class="company-details">
                <p><strong>Your Company Name</strong></p>
                <p>1234 Street Address</p>
                <p>City, State, ZIP Code</p>
                <p>Email: info@yourcompany.com</p>
                <p>Phone: (123) 456-7890</p>
            </div>
        </div>

        <h1>Bill #{{ $bill->bill_no }}</h1>

        <div class="bill-info">
            <p><strong>Customer:</strong> {{ $bill->customer->full_name }}</p>
            <p><strong>Invoice Date:</strong> {{ $bill->bill_date }}</p>
            <p><strong>Invoice Number:</strong> {{ $bill->bill_no }}</p>
        </div>

        <h2>Item Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Sl.no</th>
                    <th>Description</th>
                    <th>Days</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($combined as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data[0] }}</td>
                        <td>{{ $data[1] }}</td>
                        <td>₹{{ $data[2] }}</td>
                        <td>₹{{ $data[3] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <p><strong>Sub Total:</strong> {{ $bill->sub_total }}</p>
            <p><strong>Discount:</strong> {{ $bill->discount }}</p>
            <p><strong>Total Amount:</strong> {{ $bill->total_amount }}</p>
        </div>
    </div>
</body>

</html>
