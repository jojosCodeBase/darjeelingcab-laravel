@extends('layouts.main')
@section('title', 'Darjeeling Cab FAQs - Frequently Asked Questions')
@section('meta-tags')
    <meta name="description"
        content="Find answers to frequently asked questions about Darjeeling Cab. Learn about booking process, fares from NJP & Bagdogra, sightseeing, routes, safety, policies, and 24/7 support." />
    <meta name="keywords"
        content="Darjeeling Cab FAQ, NJP to Darjeeling taxi fare, Bagdogra to Darjeeling cab cost, Darjeeling sightseeing taxi, Gangtok cab service, taxi booking help, Darjeeling travel FAQ" />
    <meta name="author" content="Darjeeling Cab" />
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Darjeeling Cab FAQs - Frequently Asked Questions">
    <meta property="og:description"
        content="Darjeeling Cab answers your FAQs about cab booking, fares, sightseeing, NJP/Bagdogra routes, car types, safety, cancellation, and 24/7 taxi service in Darjeeling." />
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="Darjeeling Cab">
    <meta property=og:image content="{{ asset('assets/images/favicon.ico') }}">
@endsection

@section('content')
    <div class="container blogs-container">
        <div class="row">
            <h3 class="mb-4 page-title text-brand">Frequently Travelled Routes</h3>

            <div class="col-lg-12">
                <!-- Hero Section -->
                <div class="hero-section mb-5 p-4 rounded"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-3">Darjeeling to NJP Taxi Service</h1>
                            <p class="lead mb-3">Comfortable and reliable taxi service from the Queen of Hills to New
                                Jalpaiguri Railway Station. Experience hassle-free travel with our professional drivers and
                                well-maintained vehicles.</p>
                            <div class="row text-center">
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="bg-white text-dark bg-opacity-20 rounded p-2">
                                        <strong>68 km</strong><br><small>Distance</small>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="bg-white text-dark bg-opacity-20 rounded p-2">
                                        <strong>2.5-3 hrs</strong><br><small>Journey Time</small>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="bg-white text-dark bg-opacity-20 rounded p-2">
                                        <strong>₹2,200</strong><br><small>Starting Fare</small>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 mb-2">
                                    <div class="bg-white text-dark bg-opacity-20 rounded p-2">
                                        <strong>24/7</strong><br><small>Service</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <i class="fas fa-route fa-8x opacity-75"></i>
                        </div>
                    </div>
                </div>

                <!-- Pricing Section -->
                <section class="pricing-section mb-5">
                    <h2 class="section-title mb-4"><i class="fas fa-rupee-sign text-brand"></i> Darjeeling to NJP Taxi Fare
                    </h2>

                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card shadow-sm">
                                <div class="card-header bg-brand text-light">
                                    <h4 class="mb-0"><i class="fas fa-calculator"></i> Transparent Pricing Structure</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Vehicle Type</th>
                                                    <th>Capacity</th>
                                                    <th>One Way</th>
                                                    <th>Round Trip</th>
                                                    <th>Best For</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>AC Sedan</strong><br><small class="text-muted">Swift Dzire,
                                                            Etios</small></td>
                                                    <td>4 passengers</td>
                                                    <td><span class="badge bg-success">₹2,200</span></td>
                                                    <td><span class="badge bg-primary">₹4,000</span></td>
                                                    <td>Couples, Small families</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>AC SUV</strong><br><small class="text-muted">Innova,
                                                            Xylo</small></td>
                                                    <td>6-7 passengers</td>
                                                    <td><span class="badge bg-success">₹3,200</span></td>
                                                    <td><span class="badge bg-primary">₹5,800</span></td>
                                                    <td>Large families, Groups</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Premium SUV</strong><br><small class="text-muted">Innova
                                                            Crysta</small></td>
                                                    <td>6-7 passengers</td>
                                                    <td><span class="badge bg-success">₹3,800</span></td>
                                                    <td><span class="badge bg-primary">₹6,800</span></td>
                                                    <td>Luxury travel</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tempo Traveller</strong><br><small class="text-muted">Force,
                                                            Mahindra</small></td>
                                                    <td>12 passengers</td>
                                                    <td><span class="badge bg-success">₹5,500</span></td>
                                                    <td><span class="badge bg-primary">₹10,000</span></td>
                                                    <td>Large groups, Tours</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="alert alert-info">
                                        <h6><i class="fas fa-info-circle"></i> What's Included in Our Fares:</h6>
                                        <ul class="mb-0">
                                            <li>✅ Fuel costs and toll charges</li>
                                            <li>✅ Experienced driver charges</li>
                                            <li>✅ Vehicle insurance coverage</li>
                                            <li>✅ GST (No additional tax)</li>
                                            <li>✅ Free cancellation up to 24 hours</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow-sm mb-3">
                                <div class="card-header bg-brand text-white">
                                    <h5 class="mb-0"><i class="fas fa-percent"></i> Special Offers</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <h6 class="text-brand">🎯 Round Trip Discount</h6>
                                        <p class="small">Save up to ₹400 on return bookings</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-brand">⭐ Early Bird Booking</h6>
                                        <p class="small">Book 3 days advance - Get 5% off</p>
                                    </div>
                                    <div class="mb-3">
                                        <h6 class="text-brand">👥 Group Discount</h6>
                                        <p class="small">2+ vehicles - Special group rates</p>
                                    </div>
                                    <div>
                                        <h6 class="text-brand">📅 Weekly Package</h6>
                                        <p class="small">7-day package with driver accommodation</p>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-sm d-none">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-clock"></i> Quick Booking</h5>
                                </div>
                                <div class="card-body text-center">
                                    <p>Need immediate taxi?</p>
                                    <a href="tel:+919876543210" class="btn btn-success btn-lg mb-2">
                                        <i class="fas fa-phone"></i> Call Now
                                    </a>
                                    <br>
                                    <a href="#" class="btn btn-primary btn-lg">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Route Information -->
                <section class="route-info mb-5">
                    <h2 class="section-title mb-4"><i class="fas fa-map-marked-alt text-brand"></i> Route Details & Travel
                        Information</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4><i class="fas fa-route"></i> Main Route</h4>
                                </div>
                                <div class="card-body">
                                    <div class="route-path">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="route-dot bg-success"></div>
                                            <div class="ms-3">
                                                <strong>Darjeeling</strong><br>
                                                <small class="text-muted">Starting Point - Mall Road, Hotels</small>
                                            </div>
                                        </div>
                                        <div class="route-line"></div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="route-dot bg-info"></div>
                                            <div class="ms-3">
                                                <strong>Kurseong</strong><br>
                                                <small class="text-muted">15 km - Tea gardens view (20 mins)</small>
                                            </div>
                                        </div>
                                        <div class="route-line"></div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="route-dot bg-warning"></div>
                                            <div class="ms-3">
                                                <strong>Siliguri</strong><br>
                                                <small class="text-muted">58 km - City center (2 hrs)</small>
                                            </div>
                                        </div>
                                        <div class="route-line"></div>
                                        <div class="d-flex align-items-center">
                                            <div class="route-dot bg-danger"></div>
                                            <div class="ms-3">
                                                <strong>New Jalpaiguri (NJP)</strong><br>
                                                <small class="text-muted">68 km - Railway Station (2.5-3 hrs)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h4><i class="fas fa-info-circle"></i> Travel Information</h4>
                                </div>
                                <div class="card-body">
                                    <div class="info-grid">
                                        <div class="info-item mb-3">
                                            <div class="d-flex">
                                                <div class="info-icon">
                                                    <i class="fas fa-road text-primary"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <strong>Road Condition:</strong><br>
                                                    Well-maintained Hill Cart Road (NH110). Some winding sections through
                                                    hills.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="info-item mb-3">
                                            <div class="d-flex">
                                                <div class="info-icon">
                                                    <i class="fas fa-cloud-sun text-info"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <strong>Best Travel Time:</strong><br>
                                                    Early morning (6-8 AM) or late afternoon (2-4 PM) for better traffic.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="info-item mb-3">
                                            <div class="d-flex">
                                                <div class="info-icon">
                                                    <i class="fas fa-gas-pump text-success"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <strong>Fuel Stops:</strong><br>
                                                    Multiple petrol pumps available in Kurseong and Siliguri.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <div class="d-flex">
                                                <div class="info-icon">
                                                    <i class="fas fa-wifi text-purple"></i>
                                                </div>
                                                <div class="ms-2">
                                                    <strong>Network Coverage:</strong><br>
                                                    Good mobile network throughout the journey. GPS tracking available.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Pickup & Drop Details -->
                <section class="pickup-details mb-5">
                    <h2 class="section-title mb-4"><i class="fas fa-map-marker-alt text-brand"></i> Pickup & Drop
                        Information</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-success">
                                <div class="card-header bg-brand text-white">
                                    <h4><i class="fas fa-arrow-circle-up"></i> Darjeeling Pickup Points</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="text-brand">Popular Locations:</h6>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-check-circle text-brand"></i> Mall Road & Chowrasta
                                                </li>
                                                <li><i class="fas fa-check-circle text-brand"></i> All Hotels & Resorts
                                                </li>
                                                <li><i class="fas fa-check-circle text-brand"></i> Darjeeling Railway
                                                    Station</li>
                                                <li><i class="fas fa-check-circle text-brand"></i> Motor Stand</li>
                                                <li><i class="fas fa-check-circle text-brand"></i> Observatory Hill</li>
                                                <li><i class="fas fa-check-circle text-brand"></i> Happy Valley Tea
                                                    Estate</li>
                                                <li><i class="fas fa-check-circle text-brand"></i> Tiger Hill area</li>
                                                <li><i class="fas fa-check-circle text-brand"></i> St. Paul's School</li>
                                            </ul>

                                            <div class="alert alert-light">
                                                <small><strong>Custom Pickup:</strong> We can pick you up from any location
                                                    within Darjeeling town. Just provide the exact address during
                                                    booking.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card border-primary">
                                <div class="card-header bg-brand text-white">
                                    <h4><i class="fas fa-arrow-circle-down"></i> NJP Drop Points</h4>
                                </div>
                                <div class="card-body">
                                    <h6 class="text-brand">Railway Station Areas:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-train text-brand"></i> <strong>NJP Railway Station</strong>
                                            <br><small class="text-muted">Main entrance, Platform side</small>
                                        </li>
                                        <li><i class="fas fa-train text-brand"></i> <strong>Station Parking</strong>
                                            <br><small class="text-muted">Designated taxi drop zone</small>
                                        </li>
                                        <li><i class="fas fa-hotel text-brand"></i> <strong>Station Area Hotels</strong>
                                            <br><small class="text-muted">Railway colony, nearby lodges</small>
                                        </li>
                                    </ul>

                                    <h6 class="text-brand mt-3">Other NJP Locations:</h6>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-plane text-info"></i> Bagdogra Airport (15 km from NJP)</li>
                                        <li><i class="fas fa-shopping-cart text-info"></i> NJP Market Area</li>
                                        <li><i class="fas fa-hospital text-info"></i> Hospitals & Medical centers</li>
                                    </ul>

                                    <div class="alert alert-info">
                                        <small><strong>Train Connection Service:</strong> We track your train timing and
                                            ensure you reach the platform 30 minutes before departure.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Booking Process -->
                <section class="booking-process mb-5">
                    <h2 class="section-title mb-4"><i class="fas fa-calendar-check text-brand"></i> How to Book Your Taxi
                    </h2>

                    <div class="row">
                        <div class="col-md-3 col-6 mb-4">
                            <div class="text-center">
                                <div class="process-step bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <span class="h4 mb-0">1</span>
                                </div>
                                <h5>Contact Us</h5>
                                <p class="small">Call, WhatsApp, or use our online booking form</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="text-center">
                                <div class="process-step bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <span class="h4 mb-0">2</span>
                                </div>
                                <h5>Share Details</h5>
                                <p class="small">Pickup location, date, time, and passenger count</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="text-center">
                                <div class="process-step bg-warning text-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <span class="h4 mb-0">3</span>
                                </div>
                                <h5>Get Quote</h5>
                                <p class="small">Instant fare calculation and vehicle confirmation</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6 mb-4">
                            <div class="text-center">
                                <div class="process-step bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                    style="width: 60px; height: 60px;">
                                    <span class="h4 mb-0">4</span>
                                </div>
                                <h5>Confirm & Pay</h5>
                                <p class="small">Book with advance payment or pay directly to driver</p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5><i class="fas fa-phone-square-alt text-success"></i> Ready to Book Your Darjeeling
                                        to NJP Taxi?</h5>
                                    <p class="mb-2">Get instant booking confirmation with our 24/7 customer support</p>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item"><i class="fas fa-check text-success"></i> Instant
                                            confirmation</li>
                                        <li class="list-inline-item"><i class="fas fa-check text-success"></i>
                                            Professional drivers</li>
                                        <li class="list-inline-item"><i class="fas fa-check text-success"></i> Clean
                                            vehicles</li>
                                        <li class="list-inline-item"><i class="fas fa-check text-success"></i> On-time
                                            pickup</li>
                                    </ul>
                                </div>
                                <div class="col-md-4 text-center">
                                    <a href="tel:+919876543210" class="btn btn-success btn-lg mb-2 w-100">
                                        <i class="fas fa-phone"></i> Call: +91-98765-43210
                                    </a>
                                    <a href="#" class="btn btn-primary btn-lg w-100">
                                        <i class="fab fa-whatsapp"></i> WhatsApp Booking
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
