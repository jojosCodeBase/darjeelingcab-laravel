@extends('layouts.main')
@section('title', 'Contact Us')
<style>
    .contact-section {
        background-color: #f9f9f9;
        padding: 40px 0;
    }

    .contact-form {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .contact-form h3 {
        font-weight: 700;
        color: #2c3e50;
    }

    .form-group label {
        color: #2c3e50;
    }

    .form-control {
        border-radius: 5px;
        border-color: #ced4da;
    }

    .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
    }
</style>
@section('content')
    <div class="container mt-5 contact-section">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="contact-form">
                    <h3 class="mb-4 text-center">Contact Us</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
