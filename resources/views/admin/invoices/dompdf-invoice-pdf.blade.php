<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $invoice->invoice_no }}</title>
    <style>
        /* Modern Base Styles - mPDF Optimized */
        body {
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #444;
            line-height: 1.2;
            /* Reduced from 1.5 */
            background-color: #fff;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 0px;
        }

        /* Fixed Header Table */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            /* Reduced from 10px */
        }

        .header-table td {
            vertical-align: top;
            border: none;
            padding: 0;
        }

        .logo {
            height: 65px;
            /* Reduced slightly from 80px */
            width: auto;
            margin-bottom: 5px;
        }

        .invoice-label {
            font-size: 28px;
            /* Reduced from 32px */
            font-weight: 300;
            color: #00796b;
            text-transform: uppercase;
            margin: 0;
            line-height: 1;
        }

        /* Meta Section Table */
        .meta-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            /* Reduced from 30px */
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .meta-table td {
            padding: 10px 10px;
            /* Reduced from 20px */
            vertical-align: top;
            width: 33%;
        }

        .meta-label {
            font-size: 10px;
            font-weight: bold;
            color: #00796b;
            text-transform: uppercase;
            margin-bottom: 3px;
            display: block;
        }

        .meta-value {
            font-size: 14px;
            /* Reduced from 14px */
            font-weight: 600;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .items-table th {
            background-color: #f8fbfb;
            color: #00796b;
            text-transform: uppercase;
            font-size: 10px;
            font-weight: bold;
            padding: 8px 10px;
            /* Reduced from 12px */
            border-bottom: 2px solid #00796b;
            text-align: left;
        }

        .items-table td {
            padding: 8px 10px;
            /* Reduced from 15px */
            border-bottom: 1px solid #eee;
            font-size: 12px;
        }

        .item-desc {
            font-weight: 600;
            color: #333;
            display: block;
        }

        .item-date {
            font-size: 10px;
            color: #888;
        }

        /* Summary Section */
        .summary-table-container {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            /* Reduced from 20px */
        }

        .summary-table-container td {
            vertical-align: top;
        }

        .words-card {
            background-color: #f8fbfb;
            padding: 10px;
            /* Reduced from 15px */
            border-radius: 8px;
            margin-right: 20px;
        }

        .calculation-table {
            width: 100%;
            border-collapse: collapse;
        }

        .calculation-table td {
            padding: 4px 10px;
            /* Reduced from 8px */
            font-size: 13px;
            text-align: right;
        }

        .calculation-table .label {
            color: #888;
        }

        .calculation-table .value {
            /* font-weight: 600; */
            width: 120px;
        }

        .total-row td {
            border-top: 1px solid #eee;
            padding-top: 8px;
            /* Reduced from 15px */
        }

        .total-row .value {
            font-size: 18px;
            /* Reduced from 20px */
            color: #00796b;
            /* font-weight: 900; */
        }

        /* Footer Section */
        .footer {
            margin-top: 30px;
            /* Reduced from 60px */
            padding-top: 15px;
            border-top: 1px solid #eee;
            text-align: center;
        }

        .footer p {
            font-size: 10px;
            color: #aaa;
            margin: 2px 0;
        }

        .footer-info {
            color: #666 !important;
            font-weight: 600;
        }

        .payment-status-badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 50px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .paid {
            background: #e0f2f1;
            color: #00796b;
        }

        .advance-paid {
            background: #fff8e1;
            /* Very light amber */
            color: #b7791f;
            /* Deep golden brown for readability */
        }

        .unpaid {
            background: #fef2f2;
            /* Very light red/pink */
            color: #dc2626;
            /* Strong red text */
        }

        .rupee {
            /* DejaVu Sans is the standard font in DomPDF for Unicode symbols */
            font-family: 'DejaVu Sans', sans-serif !important;
            /* Often the Rupee symbol looks a bit larger than Helvetica,
                so we slightly reduce the font-size to match perfectly */
            font-size: 0.95em;
        }
    </style>
</head>

<body>
    <div class="container">

        <table class="header-table">
            <tr>
                <td>
                    <img src="https://darjeelingcab.in/assets/images/white-logo.png" alt="Logo" class="logo">
                </td>
                <td style="text-align: right; vertical-align: top;">
                    <h2 class="invoice-label">Invoice</h2>
                    <p style="margin: 5px 0 0 0; font-weight: bold; font-size: 13px;"># {{ $invoice->invoice_no }}</p>
                    <p style="margin: 0; font-size: 12px; color: #888;">Issued:
                        {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}</p>
                </td>
            </tr>
        </table>

        <table class="meta-table">
            <tr>
                <td>
                    <span class="meta-label">Billed To</span>
                    <div class="meta-value">
                        {{ $customer->full_name }}<br>
                        <p style="font-weight: normal; color: #666; font-size: 12px; margin: 3px; 3px">
                            {{ $customer->phone_no }}<br>
                            {{ $customer->address }}, {{ $customer->city }}, {{ $customer->state }}
                        </p>
                    </div>
                </td>
                <td style="text-align: center;">
                    <span class="meta-label">Payment Status</span>
                    <div class="meta-value">
                        <span
                            class="payment-status-badge {{ $invoice->payment_status == 'paid'
                                ? 'paid'
                                : ($invoice->payment_status == 'unpaid'
                                    ? 'unpaid'
                                    : 'advance-paid') }}">
                            {{ str_replace('-', ' ', $invoice->payment_status) }}
                        </span>
                    </div>
                </td>
                <td style="text-align: right;">
                    <span class="meta-label">Vehicle Type</span>
                    <div class="meta-value" style="font-size: 12px; font-weight: normal;">
                        @forelse ($vehicle_type as $value)
                            {{ $value }}{{ !$loop->last ? ', ' : '' }}
                        @empty
                            <p>Not mentioned</p>
                        @endforelse
                    </div>
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>Service Description</th>
                    <th style="text-align: right; width: 80px;">Price</th>
                    <th style="text-align: center; width: 40px;">Qty</th>
                    <th style="text-align: right; width: 90px;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dates as $index => $date)
                    <tr>
                        <td style="color: #ccc;">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <span class="item-desc">{{ $description[$index] }}</span>
                            <span class="item-date">{{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</span>
                        </td>
                        <td style="text-align: right;"><span
                                class="rupee">₹</span>{{ number_format($prices[$index], 0) }}</td>
                        <td style="text-align: center;">{{ $quantities[$index] }} veh.</td>
                        <td style="text-align: right; font-weight: bold;"><span
                                class="rupee">₹</span>{{ number_format($amounts[$index], 2) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary-table-container">
            <tr>
                <td style="width: 55%;">
                    <div class="words-card">
                        <div style="width: 100%;">
                            <span class="meta-label" style="float: left;">Amount in Words</span>
                            <span style="float: right; font-size: 8px; color: #aaa; font-weight: bold;">E. & O.E.</span>
                            <div style="clear: both;"></div>
                        </div>
                        <p style="margin: 2px 0 0 0; font-size: 12px; font-weight: 600; color: #111;">
                            @inr_words($invoice->total_amount)
                        </p>
                    </div>
                </td>
                <td style="width: 45%;">
                    <table class="calculation-table">
                        <tr>
                            <td class="label">Subtotal</td>
                            <td class="value" style="font-weight: bold;">
                                <span class="rupee">₹</span>
                                {{ number_format($invoice->total_amount, 2) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Amount Paid</td>
                            <td class="value" style="font-weight: bold;">
                                <span class="rupee">₹</span>
                                {{ number_format($invoice->received_amount, 2) }}
                            </td>
                        </tr>
                        <tr class="total-row">
                            <td class="label" style="font-weight: bold; color: #333;">Balance Due</td>
                            <td class="value" style="font-weight: bold;"><span
                                    class="rupee">₹</span>{{ number_format($invoice->balance_due, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div class="footer">
            <p class="footer-info">info@darjeelingcab.in | 9339342603 | www.darjeelingcab.in</p>
            <p style="margin-top: 8px;">Peshok Tea Garden, Darjeeling - 734312, West Bengal, IN</p>
            <p style="margin-top: 8px; font-style: italic;">This is a system generated invoice. No signature required.
            </p>
        </div>
    </div>
</body>

</html>
