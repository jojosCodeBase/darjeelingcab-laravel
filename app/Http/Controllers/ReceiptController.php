<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use View;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::with(['bill', 'customer'])->orderBy('payment_date', 'desc')->get();
        return view('admin.receipts.index', compact('receipts'));
    }

    public function create()
    {
        $bills = Bill::all();
        $customers = Customer::all();
        return view('admin.receipts.create', compact('bills', 'customers'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'bill_id' => 'required|exists:bills,id',
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'balance' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'payment_status' => 'required|in:Advance Paid,Fully Paid,Failed',
            'payment_date' => 'required|date',
        ]);

        // Create a new receipt
        Receipt::create($request->all());

        // Redirect to the receipts index with a success message
        return redirect()->route('receipts')->with('success', 'Receipt created successfully.');
    }

    public function getCustomerBills($customerId)
    {
        $bills = Bill::where('customer_id', $customerId)->get(['id', 'total_amount']);
        return response()->json(['bills' => $bills]);
    }

    public function generateReceipt(Request $request)
    {
        $receipt = Receipt::with('customer')->find($request->receipt_id);

        $data = [
            'receipt_no' => 'DC-' . date('Y') . '-RC-' . $receipt->id,
            'bill_no' => $receipt->bill_id,
            'amount' => $receipt->amount,
            'balance' => $receipt->balance,
            'payment_method' => $receipt->payment_method,
            'payment_date' => \Carbon\Carbon::parse($receipt->payment_created_at)->format('d M Y'),
            'customer_type' => $receipt->customer->customer_type,
            'name' => $receipt->customer->full_name,
            'phone_no' => $receipt->customer->phone_no,
            'email' => $receipt->customer->email ?? 'NA',
            'address' => $receipt->customer->address,
        ];

        $html = View::make('admin.bills.receipt', $data)->render();

        // Initialize mPDF with margins set to 0
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);

        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output the PDF as a download
        return response()->stream(
            function () use ($mpdf, $data) {
                $mpdf->Output($data['receipt_no'] . ".pdf", 'D');
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $data['receipt_no'] . '.pdf',
            ]
        );
    }
}
