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
            'dates' => 'required|array',
            'price' => 'required|array',
            'amount' => 'required|array',
            'sub_total' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
        ]);

        // Prepare data for insertion
        $bill = new Bill();
        $bill->customer_id = $validatedData['party_id'];
        $bill->bill_date = $validatedData['invoice_date'];
        $bill->bill_no = $validatedData['invoice_no'];
        $bill->description = json_encode($validatedData['description']);
        $bill->dates = json_encode($validatedData['dates']);
        $bill->price = json_encode($validatedData['price']);
        $bill->amount = json_encode($validatedData['amount']);
        $bill->sub_total = $validatedData['sub_total'];
        $bill->discount = $validatedData['discount'] ?? 0; // Default to 0 if not provided
        $bill->total_amount = $validatedData['total'];

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
    public function edit(Bill $bill)
    {
        $customers = Customer::orderBy('full_name')->get();
        return view('admin.bills.edit', compact('bill', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'party_id' => 'required|integer',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string',
            'description' => 'required|array',
            'dates' => 'required|array',
            'price' => 'required|array',
            'amount' => 'required|array',
            'sub_total' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'total' => 'required|numeric',
        ]);

        // Find the existing bill by ID
        $bill = Bill::findOrFail($id);

        // Update bill attributes
        $bill->customer_id = $validatedData['party_id'];
        $bill->bill_date = $validatedData['invoice_date'];
        $bill->bill_no = $validatedData['invoice_no'];
        $bill->description = json_encode($validatedData['description']);
        $bill->dates = json_encode($validatedData['dates']);
        $bill->price = json_encode($validatedData['price']);
        $bill->amount = json_encode($validatedData['amount']);
        $bill->sub_total = $validatedData['sub_total'];
        $bill->discount = $validatedData['discount'] ?? 0; // Default to 0 if not provided
        $bill->total_amount = $validatedData['total'];

        // Save the updated bill
        $bill->save();

        // Redirect with success message
        return redirect()->route('bills')->withSuccess('Bill updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
