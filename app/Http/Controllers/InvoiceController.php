<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('customer')->orderByDesc('created_at')->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('full_name')->get();
        return view('admin.invoices.create', compact('customers'));
    }
    public function instant_invoice()
    {
        return view('admin.invoices.create-instant');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'booking_id' => 'required|integer|exists:bookings,id',
            'party_id' => 'required|integer',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string',
            'vehicle_details' => 'required|array',
            'payment_status' => 'required|string',
            'description' => 'required|array',
            'dates' => 'required|array',
            'price' => 'required|array',
            'amount' => 'required|array',
            'balance_due' => 'required|numeric|gt:0',
            'received_amount' => 'nullable|numeric',
            'total' => 'required|numeric|gt:0',
        ]);

        try {

            // get the vehicle details from bookings table

            // $vehicle_details = Booking::where('id', $validated['booking_id'])->value('vehicle')

            // Prepare data for insertion
            $invoice = new Invoice();

            $invoice->booking_id = $validatedData['booking_id'];
            $invoice->customer_id = $validatedData['party_id'];
            $invoice->bill_date = $validatedData['invoice_date'];
            $invoice->bill_no = $validatedData['invoice_no'];
            $invoice->vehicle_details = json_encode($validatedData['vehicle_details']);
            $invoice->payment_status = $validatedData['payment_status'];
            $invoice->description = json_encode($validatedData['description']);
            $invoice->dates = json_encode($validatedData['dates']);
            $invoice->price = json_encode($validatedData['price']);
            $invoice->amount = json_encode($validatedData['amount']);
            $invoice->balance_due = (float) $validatedData['balance_due'];
            $invoice->received_amount = (float) $validatedData['received_amount'] ?? 0; // Default to 0 if not provided
            $invoice->total_amount = (float) $validatedData['total'];

            $invoice->save();

            return redirect()->route('invoices')->withSuccess('Bill saved successfully');
        } catch (Exception $e) {
            Log::error('Some error occured in generating bill for booking id -- ' . $request->booking_id . ' -- error -- ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to generate bill.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $customers = Customer::all();
        return view('admin.invoices.show', compact('invoice', 'customers'));
    }

    public function generatePDF(Invoice $invoice)
    {
        try {
            $customer = Customer::find($invoice->customer_id);

            if ($invoice->payment_status == "advance-paid") {
                $payment_status = "Advance Paid";
            } else {
                $payment_status = "Not Paid";
            }

            $data = [
                'bill' => $invoice,
                'customer' => $customer,
                'description' => json_decode($invoice->description),
                'dates' => json_decode($invoice->dates),
                'prices' => json_decode($invoice->price),
                'amounts' => json_decode($invoice->amount),
                'vehicle_details' => $invoice->vehicle_details,
                'payment_status' => $payment_status,
            ];

            // return view('admin.invoices.pdf', [
            //     'bill' => $invoice,
            //     'customer' => $customer,
            //     'description' => json_decode($invoice->description),
            //     'dates' => json_decode($invoice->dates),
            //     'prices' => json_decode($invoice->price),
            //     'amounts' => json_decode($invoice->amount),
            //     'vehicle_details' => $invoice->vehicle_details,
            //     'payment_status' => $payment_status,
            // ]);

            // Render the Blade view to HTML
            $html = View::make('admin.invoices.invoice-pdf', $data)->render();

            // Initialize mPDF with margins set to 0
            $mpdf = new Mpdf([
                'margin_left' => 0,
                'margin_right' => 0,
                'margin_top' => 0,
                'margin_bottom' => 0,
            ]);

            // Write HTML to PDF
            $mpdf->WriteHTML($html);

            $filename = 'Invoice - ' . $invoice->bill_no . '.pdf';

            // Output the PDF as a download
            return response()->stream(
                function () use ($mpdf, $filename) {
                    $mpdf->Output($filename, 'I');
                },
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename=' . $filename . '',
                ]
            );
        } catch (Exception $e) {
            Log::error('Failed to generate invoice pdf -- ' . $e->getMessage() . ' -- on line -- ' . $e->getLine());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        if (!is_null($invoice->booking_id)) {
            $customers = Customer::orderBy('full_name')->get();
            return view('admin.invoices.edit', compact('invoice', 'customers'));
        } else {
            return view('admin.invoices.edit-instant', compact('invoice'));
        }
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
            'vehicle_details' => 'required|string',
            'payment_status' => 'required|string',
            'description' => 'required|array',
            'dates' => 'required|array',
            'price' => 'required|array',
            'amount' => 'required|array',
            'sub_total' => 'required|numeric',
            'received_amount' => 'nullable|numeric',
            'total' => 'required|numeric',
        ]);

        // Find the existing invoice by ID
        $invoice = Invoice::findOrFail($id);

        // Update invoice attributes
        $invoice->customer_id = $validatedData['party_id'];
        $invoice->invoice_date = $validatedData['invoice_date'];
        $invoice->invoice_no = $validatedData['invoice_no'];
        $invoice->vehicle_details = $validatedData['vehicle_details'];
        $invoice->payment_status = $validatedData['payment_status'];
        $invoice->description = json_encode($validatedData['description']);
        $invoice->dates = json_encode($validatedData['dates']);
        $invoice->price = json_encode($validatedData['price']);
        $invoice->amount = json_encode($validatedData['amount']);
        $invoice->sub_total = $validatedData['sub_total'];
        $invoice->received_amount = $validatedData['received_amount'] ?? 0; // Default to 0 if not provided
        $invoice->total_amount = $validatedData['total'];

        // Save the updated invoice
        $invoice->save();

        // Redirect with success message
        return redirect()->route('invoices')->withSuccess('Invoice updated successfully');
    }

    public function store_instant(Request $request)
    {
        // Validate data. 
        // booking_id and party_id are NULLABLE here because this is an "Instant" manual invoice.
        $validatedData = $request->validate([
            'manual_name' => 'required|string|max:255',
            'manual_phone' => 'required|string|max:20',
            'manual_address' => 'nullable|string',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string|unique:invoices,invoice_no',
            'payment_status' => 'required|string',
            'description' => 'required|array',
            'dates' => 'required|array',
            'amount' => 'required|array', // This is what we use for row totals
            'total' => 'required|numeric',
            'received_amount' => 'nullable|numeric',
            'balance_due' => 'required|numeric',
        ]);

        try {
            // Prepare a new Invoice instance (Assuming your model is named Invoice)
            $invoice = new Invoice();

            // 1. Manual Customer Data
            $invoice->manual_customer_name = $validatedData['manual_name'];
            $invoice->manual_customer_phone = $validatedData['manual_phone'];
            $invoice->manual_customer_address = $validatedData['manual_address'];

            // 2. IDs remain null for Instant Invoices
            $invoice->customer_id = null;
            $invoice->booking_id = null;

            // 3. Invoice Settings
            $invoice->invoice_date = $validatedData['invoice_date'];
            $invoice->invoice_no = $validatedData['invoice_no'];
            $invoice->payment_status = $validatedData['payment_status'];

            // 4. Invoice Data (Arrays)
            // Note: Model casting handles the json_encode automatically
            $invoice->description = $validatedData['description'];
            $invoice->dates = $validatedData['dates'];
            $invoice->amount = $validatedData['amount'];
            // Using amount as price for instant simplified invoice, or map as needed
            $invoice->price = $validatedData['amount'];

            // Instant invoice usually don't have pre-assigned vehicle details in the DB, 
            // but if you added them manually in the UI, grab them here:
            // $invoice->vehicle_details = null;

            // 5. Financials
            $invoice->total_amount = $validatedData['total'];
            $invoice->received_amount = $validatedData['received_amount'] ?? 0;
            $invoice->balance_due = $validatedData['balance_due'];

            $invoice->save();

            return redirect()->route('invoices')->with('success', 'Invoice generated successfully');

        } catch (Exception $e) {
            Log::error('Instant invoice Error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors('Failed to generate manual invoice. ' . $e->getMessage());
        }
    }

    public function update_instant(Request $request, Invoice $invoice)
    {
        // Validate data. 
        // booking_id and party_id are NULLABLE here because this is an "Instant" manual invoice.
        $validatedData = $request->validate([
            'manual_name' => 'required|string|max:255',
            'manual_phone' => 'required|string|max:20',
            'manual_address' => 'nullable|string',
            'invoice_date' => 'required|date',
            'payment_status' => 'required|string',
            'description' => 'required|array',
            'dates' => 'required|array',
            'amount' => 'required|array', // This is what we use for row totals
            'total' => 'required|numeric',
            'received_amount' => 'nullable|numeric',
            'balance_due' => 'required|numeric',
        ]);

        try {
            // Prepare a new Invoice instance (Assuming your model is named Invoice)

            // 1. Manual Customer Data
            $invoice->manual_customer_name = $validatedData['manual_name'];
            $invoice->manual_customer_phone = $validatedData['manual_phone'];
            $invoice->manual_customer_address = $validatedData['manual_address'];

            // 2. IDs remain null for Instant Invoices
            $invoice->customer_id = null;
            $invoice->booking_id = null;

            // 3. Invoice Settings
            $invoice->invoice_date = $validatedData['invoice_date'];
            // $invoice->invoice_no = $validatedData['invoice_no'];
            $invoice->payment_status = $validatedData['payment_status'];

            // 4. Invoice Data (Arrays)
            // Note: Model casting handles the json_encode automatically
            $invoice->description = json_encode($validatedData['description']);
            $invoice->dates = json_encode($validatedData['dates']);
            $invoice->amount = json_encode($validatedData['amount']);
            // Using amount as price for instant simplified invoice, or map as needed
            $invoice->price = json_encode($validatedData['amount']);

            // Instant invoice usually don't have pre-assigned vehicle details in the DB, 
            // but if you added them manually in the UI, grab them here:
            // $invoice->vehicle_details = $request->input('vehicle_details', []);

            // 5. Financials
            $invoice->total_amount = $validatedData['total'];
            $invoice->received_amount = $validatedData['received_amount'] ?? 0;
            $invoice->balance_due = $validatedData['balance_due'];

            $invoice->save();

            return redirect()->route('invoices')->with('success', 'Invoice updated successfully');

        } catch (Exception $e) {
            Log::error('Instant Invoice Updation Error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->withErrors('Failed to update manual invoice. ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
