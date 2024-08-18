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
    <meta property="og:url" content="https://www.darjeelingcab.in/contact">
    <link rel="canonical" href="https://www.darjeelingcab.in/contact">
    <meta property="og:site_name" content="Darjeeling Cab">
    <meta property=og:image content="{{ asset('assets/images/favicon.ico') }}">
@endsection
@section('title', 'Contact Darjeeling Cab - Book Your Ride Today')
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
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your name" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="subject">Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="Enter subject" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="message">Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5"
                                placeholder="Start typing your message here...." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
