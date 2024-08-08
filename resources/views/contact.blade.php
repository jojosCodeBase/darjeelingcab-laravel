@extends('layouts.main')
@section('title', 'Contact Us')
<style>
    .contact-section {
        /* background-color: #f9f9f9; */
        padding: 40px 0;
    }

    .contact-form {
        background-color: #f9f9f9;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .form-group label {
        color: #2c3e50;
    }

    .form-control {
        border-radius: 5px;
        border-color: #ced4da;
    }
</style>
@section('content')
    <div class="container mt-5 contact-section">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="contact-form">
                    <h3 class="mb-4 text-center text-brand">Contact Us</h3>
                    <form action="#" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="subject">Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Start typing your message here...." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
