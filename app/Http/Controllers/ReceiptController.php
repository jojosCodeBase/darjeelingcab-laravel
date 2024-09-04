<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index()
    {
        $receipts = Receipt::with(['bill', 'customer'])->orderBy('payment_date', 'desc')->get();
        return view('admin.receipts.index', compact('receipts'));
    }

    public function create(){
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

    public function getCustomerBills($customerId){
        $bills = Bill::where('customer_id', $customerId)->get(['id', 'total_amount']);
        return response()->json(['bills' => $bills]);
    }
}
