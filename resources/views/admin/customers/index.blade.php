@extends('layouts.admin-main')
@section('title', 'Customers')
@section('content')
    <div class="container-fluid p-0">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-between">
                    <div class="col">
                        <h4 class="header-title text-uppercase">Customers</h4>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('customer.create') }}" class="btn btn-primary">Add Customer</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>#</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->customer_type }}</td>
                                    <td>{{ $customer->full_name }}</td>
                                    <td>{{ $customer->phone_no }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#customerModal" data-type="{{ $customer->customer_type }}"
                                            data-name="{{ $customer->full_name }}" data-phone="{{ $customer->phone_no }}"
                                            data-email="{{ $customer->email }}" data-address="{{ $customer->address }}">
                                            <i class="align-middle" data-feather="eye"></i>
                                        </button>
                                        <a href="{{ route('customer.edit', ['customer' => $customer->id]) }}" class="btn btn-success"><i class="align-middle" data-feather="edit"></i></a>
                                        <form action="{{ route('customer.destroy', $customer->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger delete-button"><i
                                                    class="align-middle" data-feather="trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No customers found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Type:</strong> <span id="customerType"></span></p>
                    <p><strong>Name:</strong> <span id="customerName"></span></p>
                    <p><strong>Phone:</strong> <span id="customerPhone"></span></p>
                    <p><strong>Email:</strong> <span id="customerEmail"></span></p>
                    <p><strong>Address:</strong> <span id="customerAddress"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).on('click', '.delete-button', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            if (confirm('Do you want to delete this customer?')) {
                form.submit();
            }
        });

        $('#customerModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var customerType = button.data('type'); // Extract info from data-* attributes
            var customerName = button.data('name');
            var customerPhone = button.data('phone');
            var customerEmail = button.data('email');
            var customerAddress = button.data('address');

            var modal = $(this);
            modal.find('#customerType').text(customerType);
            modal.find('#customerName').text(customerName);
            modal.find('#customerPhone').text(customerPhone);
            modal.find('#customerEmail').text(customerEmail);
            modal.find('#customerAddress').text(customerAddress);
        });
    </script>
@endsection
