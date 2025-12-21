<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Invoice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\Facade\Pdf; // Ensure you import the Facade


class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('customer')->orderByDesc('created_at')->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::orderBy('full_name')->get();
        return view('admin.invoices.create', compact('customers'));
    }
    public function instant_invoice()
    {
        return view('admin.invoices.create-instant');
    }

    public function show(Invoice $invoice)
    {
        $customers = Customer::all();
        return view('admin.invoices.show', compact('invoice', 'customers'));
    }

    public function edit(Invoice $invoice)
    {
        if (!is_null($invoice->booking_id)) {
            $customers = Customer::orderBy('full_name')->get();
            return view('admin.invoices.edit', compact('invoice', 'customers'));
        } else {
            return view('admin.invoices.edit-instant', compact('invoice'));
        }
    }

    public function store(Request $request)
    {
        return $this->processInvoice($request, 'store');
    }

    public function store_instant(Request $request)
    {
        return $this->processInvoice($request, 'store', true);
    }

    public function update(Request $request, $id)
    {
        return $this->processInvoice($request, 'update', false, $id);
    }
    
    public function update_instant(Request $request, $id)
    {
        return $this->processInvoice($request, 'update', true, $id);
    }

    /**
     * Single source of truth for saving/updating all invoice types
     */
    private function processInvoice(Request $request, $type = null, $isInstant = false, $id = null)
    {
        // 1. Unified Validation
        $rules = [
            'invoice_date' => 'required|date',
            'payment_status' => 'required|string',
            'description' => 'required|array',
            'dates' => 'required|array',
            'price' => 'required|array',
            'qty' => 'required|array',
            'amount' => 'required|array',
            'total' => 'required|numeric',
            'received_amount' => 'nullable|numeric',
            'balance_due' => 'required|numeric',
        ];

        if ($isInstant) {
            $rules['manual_name'] = 'required|string|max:255';
        } else {
            $rules['party_id'] = 'required|integer';
            $rules['booking_id'] = ($id) ? 'nullable' : 'required|exists:bookings,id';
        }

        $validated = $request->validate($rules);

        $error_message = "";

        try {
            // 2. Find or Create
            $invoice = $id ? Invoice::findOrFail($id) : new Invoice();

            // 3. Map Fields (Model Casting handles JSON automatically)
            if ($isInstant) {
                $invoice->manual_customer_name = $validated['manual_name'];
                $invoice->manual_customer_phone = $request->manual_phone;
                $invoice->manual_customer_address = $request->manual_address;
                $invoice->customer_id = null;
                $invoice->booking_id = null;
            } else {
                $invoice->customer_id = $validated['party_id'];
                if (!$id)
                    $invoice->booking_id = $validated['booking_id'];
            }

            $invoice->invoice_date = $validated['invoice_date'];
            $invoice->payment_status = $validated['payment_status'];
            $invoice->description = json_encode($validated['description']);
            $invoice->dates = json_encode($validated['dates']);
            $invoice->price = json_encode($validated['price']);
            $invoice->qty = json_encode($validated['qty']);
            $invoice->amount = json_encode($validated['amount']);
            $invoice->total_amount = $validated['total'];
            $invoice->received_amount = $validated['received_amount'] ?? 0;
            $invoice->balance_due = $validated['balance_due'];

            // Only set vehicle details if provided (Normal invoices)
            // if ($request->has('vehicle_details')) {
            //     $invoice->vehicle_details = $request->vehicle_details;
            // }

            $invoice->save();

            if ($type == 'store') {
                $message = 'created';
                $error_message = 'creation';
            } else {
                $message = 'updated';
                $error_message = 'updation';
            }

            return redirect()->route('invoices')->withSuccess("Invoice {$message} successfully");

        } catch (Exception $e) {
            \Log::error("Invoice Processing Error during -- {$error_message} -- : " . $e->getMessage());
            return redirect()->back()->withInput()->withErrors('Error: ' . $e->getMessage());
        }
    }


    public function generatePDFOld(Invoice $invoice)
    {
        try {
            $customer = Customer::findOrFail($invoice->customer_id);
            $booking = Booking::findOrFail($invoice->booking_id);

            $vehicle_type = $booking->vehicle_type ?? [];

            if ($invoice->payment_status == "advance-paid") {
                $payment_status = "Advance Paid";
            } else {
                $payment_status = "Not Paid";
            }

            $data = [
                'invoice' => $invoice,
                'customer' => $customer,
                'description' => json_decode($invoice->description),
                'dates' => json_decode($invoice->dates),
                'prices' => json_decode($invoice->price),
                'quantities' => json_decode($invoice->qty),
                'amounts' => json_decode($invoice->amount),
                'vehicle_type' => json_decode($vehicle_type),
                'payment_status' => $payment_status,
            ];

            // return view('admin.invoices.invoice-pdf', [
            //     'invoice' => $invoice,
            //     'customer' => $customer,
            //     'description' => json_decode($invoice->description),
            //     'dates' => json_decode($invoice->dates),
            //     'prices' => json_decode($invoice->price),
            //     'quantities' => json_decode($invoice->qty),
            //     'amounts' => json_decode($invoice->amount),
            //     'vehicle_type' => json_decode($vehicle_type),
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

            $filename = $invoice->invoice_no . '.pdf';

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

    public function generatePDF(Invoice $invoice)
    {
        try {
            $customer = Customer::find($invoice->customer_id);

            $booking = Booking::find($invoice->booking_id);

            if (is_null($customer)) {
                $customer = (object) [
                    'full_name' => $invoice->manual_customer_name,
                    'phone_no' => $invoice->manual_customer_phone, // Match the attribute name used in your Blade
                    'address' => $invoice->manual_customer_address,
                    'city' => 'NA',
                    'state' => 'NA',
                ];
            }

            $vehicle_type = !is_null($booking) ? json_decode($booking->vehicle_type) : [];
            $payment_status = ($invoice->payment_status == "advance-paid") ? "Advance Paid" : "Not Paid";

            $data = [
                'invoice' => $invoice,
                'customer' => $customer,
                'description' => json_decode($invoice->description),
                'dates' => json_decode($invoice->dates),
                'prices' => json_decode($invoice->price),
                'quantities' => json_decode($invoice->qty),
                'amounts' => json_decode($invoice->amount),
                'vehicle_type' => $vehicle_type,
                'payment_status' => $payment_status,
            ];

            // return view('admin.invoices.dompdf-invoice-pdf', [
            //     'invoice' => $invoice,
            //     'customer' => $customer,
            //     'description' => json_decode($invoice->description),
            //     'dates' => json_decode($invoice->dates),
            //     'prices' => json_decode($invoice->price),
            //     'quantities' => json_decode($invoice->qty),
            //     'amounts' => json_decode($invoice->amount),
            //     'vehicle_type' => json_decode($vehicle_type),
            //     'payment_status' => $payment_status,
            // ]);

            // 1. Load the view and pass data
            $pdf = Pdf::loadView('admin.invoices.dompdf-invoice-pdf', $data);

            // 2. Set options (optional: paper size and orientation)
            $pdf->setPaper('a4', 'portrait');

            $filename = $invoice->invoice_no . '.pdf';

            // 3. Return as a stream (view in browser) or download
            // use ->download($filename) if you want to force a download immediately
            return $pdf->stream($filename);

        } catch (Exception $e) {
            Log::error('Failed to generate invoice pdf -- ' . $e->getMessage() . ' -- on line -- ' . $e->getLine());
        }
    }

    public function destroy(string $id)
    {
        //
    }
}
