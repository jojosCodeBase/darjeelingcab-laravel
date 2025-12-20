<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function index()
    {
        $customers = Customer::latest()->get();
        return view('admin.customers.index', compact('customers'));
    }


    public function create()
    {
        return view('admin.customers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'customer_type' => 'required',
            'full_name' => 'required|string|min:2|max:100',
            'email' => 'nullable|email|unique:customers,email',
            'phone_no' => 'required|string|max:15|unique:customers,phone_no',
            'address' => 'required|string',
            'city' => 'nullable|string',
            'state' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        try {

            $data = $request->all();

            // Remove token from post data before inserting
            unset($data['_token']);

            Customer::create($data);

            return redirect()->route('customers')->withSuccess("Customer created successfully");
        } catch (Exception $e) {
            \Log::error('Failed to create customer -- ' . $e->getMessage());

            return back()->withErrors("Failed to create Customer")->withInput();
        }
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_type' => 'required',
            'full_name' => 'required|string|min:2|max:100',
            'phone_no' => 'required|string|max:15|unique:customers,phone_no,' . $id,
            'email' => 'nullable|email|unique:customers,email,' . $id,
            'address' => 'required|string',
            'city' => 'nullable|string',
            'state' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        try {

            // Find the customer by ID
            $customer = Customer::findOrFail($id);

            // Update customer details
            $customer->customer_type = $request->input('customer_type');
            $customer->full_name = $request->input('full_name');
            $customer->phone_no = $request->input('phone_no');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->city = $request->input('city');
            $customer->state = $request->input('state');
            $customer->notes = $request->input('notes');

            // Save the updated customer
            $customer->save();

            // Redirect with success message
            return redirect()->route('customers')->with('success', 'Customer updated successfully');

        } catch (Exception $e) {
            \Log::error('Failed to update customer -- ' . $e->getMessage());

            return back()->withErrors("Failed to update Customer")->withInput();
        }
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers')->with('success', 'Customer deleted successfully.');
    }
}
