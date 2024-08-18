<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Barryvdh\Snappy\Facades\SnappyPdf;
use TCPDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;

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

    public function getCustomerDetails(Request $request)
    {
        $customerId = $request->input('customer_id');
        $customer = Customer::with('bookings')->find($customerId);

        if (!$customer) {
            return response()->json(['error' => 'Customer not found.'], 404);
        }

        $bookings = $customer->bookings;
        return response()->json(['customer' => $customer, 'bookings' => $bookings]);
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

    public function generatePDF()
    {
        // Render the Blade view to HTML
        $html = View::make('admin.bills.test-pdf')->render();

        // Initialize mPDF with margins set to 0
        $mpdf = new Mpdf([
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);

        // Write HTML to PDF
        $mpdf->WriteHTML($html);

        // Output the PDF as a download
        return response()->stream(
            function () use ($mpdf) {
                $mpdf->Output('invoice.pdf', 'I');
            },
            200,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="invoice.pdf"',
            ]
        );
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
