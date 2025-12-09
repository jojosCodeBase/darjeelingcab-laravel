@extends('layouts.main')
@section('meta-tags')
    <meta name="description"
        content="Get in touch with Darjeeling Cab for all your transportation needs in Darjeeling. Contact us today to book your ride or inquire about our services. We are here to assist you." />
    <meta name="keywords"
        content="Contact Darjeeling Cab, taxi booking, Darjeeling taxi service, transportation inquiries, contact information, customer support Darjeeling Cab" />
    <meta name="author" content="Darjeeling Cab" />
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Contact Darjeeling Cab - Book Your Ride Today">
    <meta property="og:description"
        content="Need reliable transportation in Darjeeling? Contact Darjeeling Cab for taxi bookings, service inquiries, or customer support. We're just a message or call away." />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Darjeeling Cab">
    <meta property="og:image" content="{{ asset('assets/images/favicon.ico') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function enableSubmitButton() {
            document.getElementById('submit-button').disabled = false;
        }
    </script>
@endsection
@section('title', 'Contact Darjeeling Cab - Book Your Ride Today')
@section('content')
    <div class="container mt-5 contact-section">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-md-8">
                @include('include.alerts')
                <div class="contact-form shadow">
                    <h1 class="mb-4 text-center text-brand fw-bold">Contact Us</h1>
                    <form action="{{ route('contact-form-submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" value="{{ old('email') }}" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="phone">Phone <span class="text-danger">*</span></label>
                                <input type="phone" class="form-control" id="phone" name="phone"
                                    placeholder="Enter your phone number" value="{{ old('phone') }}" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="subject">Subject <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="subject" value="{{ old('subject') }}"
                                    name="subject" placeholder="Enter subject" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="message">Message (Max 1000 Characters) <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="5"
                                    placeholder="Start typing your message here...." required>{{ old('message') }}</textarea>
                            </div>
                        </div>
                        <div class="g-recaptcha mt-3" data-sitekey="6LfjWx4rAAAAAD2aLJj4yr0pQJKCwC9BJU6-n5Sg"
                            data-callback="enableSubmitButton"></div>
                        <button type="submit" id="submit-button" class="btn btn-brand mt-2" disabled>Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
