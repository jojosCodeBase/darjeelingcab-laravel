<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
            'full_name' => 'required|string|min:2|max:20',
            'phone_no' => 'required|string|max:10|unique:customers,phone_no',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required|max:255',
        ]);

        $param = $request->all();

        // Remove token from post data before inserting
        unset($param['_token']);

        Customer::create($param);

        return redirect()->route('customers')->withSuccess("Customer added successfully");
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
            'full_name' => 'required|string|min:2|max:20',
            'phone_no' => 'required|string|max:10|unique:customers,phone_no,' . $id,
            'email' => 'required|email|unique:customers,email,' . $id,
            'address' => 'required|max:255',
        ]);

        // Find the customer by ID
        $customer = Customer::findOrFail($id);

        // Update customer details
        $customer->customer_type = $request->input('customer_type');
        $customer->full_name = $request->input('full_name');
        $customer->phone_no = $request->input('phone_no');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');

        // Save the updated customer
        $customer->save();

        // Redirect with success message
        return redirect()->route('customers')->with('success', 'Customer updated successfully');
    }


    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers')->with('success', 'Customer deleted successfully.');
    }
}
