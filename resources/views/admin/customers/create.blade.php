@extends('layouts.admin-main')
@section('title', 'Add Customers')
@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-uppercase mb-3">New Customer Details</h4>
                <form class="needs-validation" method="post" action="{{ route('customer.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="validationCustom01" class="form-label">Type <span class="text-danger">*</span></label>
                                <select name="customer_type" class="form-select border-bottom" id="validationCustom01"
                                    placeholder="Please select Type" required>
                                    <option value="">Please select</option>
                                    <option value="Agent" @if (old('customer_type') == 'Agent') selected @endif>Agent</option>
                                    <option value="Customer" @if (old('customer_type') == 'Customer') selected @endif>Customer
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('full_name') }}" name="full_name"
                                    class="form-control border-bottom " id="name"
                                    placeholder="Enter customer's full name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label" for="phone">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone_no" value="{{ old('phone_no') }}"
                                    class="form-control border-bottom " id="phone"
                                    placeholder="Enter mobile number" required>
                                <div class="invalid-feedback">
                                    Please provide a Number.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="form-control border-bottom " id="email"
                                    placeholder="Enter email">
                                <div class="invalid-feedback">
                                    Please provide an email.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                <textarea id="address" cols="30" rows="5" name="address" class="form-control border-bottom" placeholder="Start typing here...." required>{{ old('address') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </form>
            </div>
        </div>
    </div>
@endsection
