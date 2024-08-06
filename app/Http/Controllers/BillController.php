<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;
use PDF;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('customer')->orderByDesc('created_at')->get();
        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('full_name')->get();
        return view('admin.bills.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'party_id' => 'required|integer',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string',
            'description' => 'required|array',
            'days' => 'required|array',
            'price' => 'required|array',
            'amount' => 'required|array',
            'tax_amount' => 'nullable|numeric',
            'net_amount' => 'required|numeric',
        ]);

        // Prepare data for insertion
        $bill = new Bill();
        $bill->customer_id = $validatedData['party_id'];
        $bill->bill_date = $validatedData['invoice_date'];
        $bill->bill_no = $validatedData['invoice_no'];
        $bill->description = json_encode($validatedData['description']);
        $bill->days = json_encode($validatedData['days']);
        $bill->price = json_encode($validatedData['price']);
        $bill->amount = json_encode($validatedData['amount']);
        $bill->sub_total = 12.00;
        $bill->discount = $validatedData['tax_amount'] ?? 0; // Default to 0 if not provided
        $bill->total_amount = $validatedData['net_amount'];

        $bill->save();

        return redirect()->route('bills')->withSuccess('Bill saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        $customers = Customer::all();
        return view('admin.bills.show', compact('bill', 'customers'));
    }

    public function generatePDF($billId)
    {
        $bill = Bill::findOrFail($billId);
        $descriptions = json_decode($bill->description, true);
        $days = json_decode($bill->days, true);
        $price = json_decode($bill->price, true);
        $amount = json_decode($bill->amount, true);
        $combined = array_map(null, $descriptions, $days, $price, $amount);

        $data = [
            'bill' => $bill,
            'combined' => $combined,
        ];

        // $pdf = PDF::loadView('admin.bills.pdf', $data);
        $pdf = PDF::loadView('admin.bills.test-pdf', $data);
        return $pdf->download('bill_' . $bill->id . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
