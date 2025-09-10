@extends('layouts.main')
@section('title', 'Darjeeling Cab Pricing - Dynamic Rate Calculator')
@section('meta-tags')
    <meta name="description"
        content="Calculate exact taxi fares instantly from NJP, Bagdogra, Siliguri to Darjeeling, Gangtok, Kalimpong. Get transparent pricing with our dynamic cab fare calculator." />
    <meta name="keywords"
        content="cab fare calculator, Darjeeling taxi rates, NJP to Darjeeling fare calculator, dynamic pricing, instant cab booking" />
@endsection

@section('content')
    <div class="container blogs-container">
        <div class="row my-5">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <h1 class="text-brand fw-bold">Frequently Travelled Routes</h1>
                <p class="text-muted">Get instant, transparent pricing for your journey</p>
            </div>

            <!-- Routes Grid -->
            <div class="row g-4">
                <!-- Route Card 1: Darjeeling to NJP -->
                <div class="col-lg-6 col-md-12">
                    <div class="card route-card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title text-brand fw-bold mb-2">Darjeeling ⟷ NJP</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-map-marker-alt me-2"></i>78 km • 2.5 hours
                                    </p>
                                </div>
                                <span class="badge bg-success fs-6">Popular</span>
                            </div>

                            <div class="route-preview mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-medium">Starting from</span>
                                    <span class="text-brand fw-bold fs-5">₹1,800</span>
                                </div>
                                <small class="text-muted">Railway station connectivity</small>
                            </div>

                            <div class="route-highlights mb-3">
                                <ul class="list-unstyled small mb-0">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Scenic mountain views</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>24/7 service available</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Multiple vehicle options</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ url('/darjeeling-to-njp') }}" class="btn btn-primary">
                                    View Detailed Pricing & Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Route Card 2: Bagdogra to Darjeeling -->
                <div class="col-lg-6 col-md-12">
                    <div class="card route-card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title text-brand fw-bold mb-2">Bagdogra ⟷ Darjeeling</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-plane me-2"></i>68 km • 2 hours
                                    </p>
                                </div>
                                <span class="badge bg-info fs-6">Airport</span>
                            </div>

                            <div class="route-preview mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-medium">Starting from</span>
                                    <span class="text-brand fw-bold fs-5">₹1,600</span>
                                </div>
                                <small class="text-muted">Direct airport transfers</small>
                            </div>

                            <div class="route-highlights mb-3">
                                <ul class="list-unstyled small mb-0">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Airport pickup available</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Tea garden routes</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Professional drivers</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ url('/bagdogra-to-darjeeling') }}" class="btn btn-primary">
                                    View Detailed Pricing & Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Route Card 3: Siliguri to Gangtok -->
                <div class="col-lg-6 col-md-12">
                    <div class="card route-card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title text-brand fw-bold mb-2">Siliguri ⟷ Gangtok</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-mountain me-2"></i>114 km • 3.5 hours
                                    </p>
                                </div>
                                <span class="badge bg-warning text-dark fs-6">Capital</span>
                            </div>

                            <div class="route-preview mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-medium">Starting from</span>
                                    <span class="text-brand fw-bold fs-5">₹2,800</span>
                                </div>
                                <small class="text-muted">Sikkim capital city</small>
                            </div>

                            <div class="route-highlights mb-3">
                                <ul class="list-unstyled small mb-0">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Himalayan views</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Permit arrangements</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Border crossing assistance</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ url('/siliguri-to-gangtok') }}" class="btn btn-primary">
                                    View Detailed Pricing & Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Route Card 4: NJP to Kalimpong -->
                <div class="col-lg-6 col-md-12">
                    <div class="card route-card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title text-brand fw-bold mb-2">NJP ⟷ Kalimpong</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-map-marker-alt me-2"></i>55 km • 2 hours
                                    </p>
                                </div>
                                <span class="badge bg-secondary fs-6">Heritage</span>
                            </div>

                            <div class="route-preview mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-medium">Starting from</span>
                                    <span class="text-brand fw-bold fs-5">₹1,500</span>
                                </div>
                                <small class="text-muted">Heritage hill station</small>
                            </div>

                            <div class="route-highlights mb-3">
                                <ul class="list-unstyled small mb-0">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Flower nurseries</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Buddhist monasteries</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Cultural experiences</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ url('/njp-to-kalimpong') }}" class="btn btn-primary">
                                    View Detailed Pricing & Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Route Card 5: Bagdogra to Gangtok -->
                <div class="col-lg-6 col-md-12">
                    <div class="card route-card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title text-brand fw-bold mb-2">Bagdogra ⟷ Gangtok</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-plane me-2"></i>124 km • 4 hours
                                    </p>
                                </div>
                                <span class="badge bg-info fs-6">Airport</span>
                            </div>

                            <div class="route-preview mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-medium">Starting from</span>
                                    <span class="text-brand fw-bold fs-5">₹3,200</span>
                                </div>
                                <small class="text-muted">Airport to Sikkim capital</small>
                            </div>

                            <div class="route-highlights mb-3">
                                <ul class="list-unstyled small mb-0">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Direct airport transfer</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Permit assistance included
                                    </li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Scenic Himalayan route</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ url('/bagdogra-to-gangtok') }}" class="btn btn-primary">
                                    View Detailed Pricing & Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Route Card 6: Darjeeling to Kalimpong -->
                <div class="col-lg-6 col-md-12">
                    <div class="card route-card h-100 shadow-sm border-0">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h5 class="card-title text-brand fw-bold mb-2">Darjeeling ⟷ Kalimpong</h5>
                                    <p class="text-muted mb-0">
                                        <i class="fas fa-route me-2"></i>50 km • 2.5 hours
                                    </p>
                                </div>
                                <span class="badge bg-success fs-6">Scenic</span>
                            </div>

                            <div class="route-preview mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-medium">Starting from</span>
                                    <span class="text-brand fw-bold fs-5">₹1,200</span>
                                </div>
                                <small class="text-muted">Hill station to hill station</small>
                            </div>

                            <div class="route-highlights mb-3">
                                <ul class="list-unstyled small mb-0">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Mountain valley views</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Tea garden landscapes</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Same day return possible</li>
                                </ul>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="{{ url('/darjeeling-to-kalimpong') }}" class="btn btn-primary">
                                    View Detailed Pricing & Book
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View All Routes Section -->
            <div class="text-center mt-5">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-brand fw-bold mb-3">Looking for Other Routes?</h4>
                        <p class="text-muted mb-4">We cover all major destinations in North Bengal and Sikkim</p>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <a href="{{ url('/all-routes') }}" class="btn btn-outline-primary">View All Routes</a>
                            <a href="{{ url('/custom-quote') }}" class="btn btn-outline-secondary">Get Custom Quote</a>
                            <a href="tel:+919876543210" class="btn btn-success">
                                <i class="fas fa-phone me-2"></i>Call Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Important Information -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="alert alert-info">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-2"></i>Important Information
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="mb-0 small">
                                    <li>All prices include driver charges and fuel</li>
                                    <li>Advance booking recommended during peak season</li>
                                    <li>24/7 customer support available</li>
                                    <li>Note: Prices may vary slightly depending on vehicle type, season, and availability.
                                        Contact
                                        us for customized tour packages or multi-day bookings.</li>
                                </ul>
                            </div>
                            {{-- <div class="col-md-6">
                                <ul class="mb-0 small">
                                    <li>Free cancellation up to 2 hours before trip</li>
                                    <li>Round trip bookings get 10% discount</li>
                                    <li>GST included in all displayed prices</li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .route-card {
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
            position: relative;
            overflow: hidden;
        }

        .route-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            transition: left 0.5s ease;
            z-index: 1;
        }

        .route-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        .route-card:hover::before {
            left: 100%;
        }

        .text-brand {
            color: #007bff;
        }

        .badge {
            font-size: 0.75rem;
            position: relative;
            z-index: 2;
        }

        .route-highlights ul li {
            margin-bottom: 5px;
        }

        .card-body {
            position: relative;
            z-index: 2;
        }

        .btn {
            position: relative;
            z-index: 3;
        }

        @media (max-width: 768px) {
            .route-card {
                margin-bottom: 20px;
            }

            .d-flex.flex-wrap.justify-content-center.gap-2 {
                flex-direction: column;
            }

            .d-flex.flex-wrap.justify-content-center.gap-2 .btn {
                margin-bottom: 10px;
            }
        }
    </style>

    <!-- Schema Markup for SEO -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "Darjeeling Taxi Service",
        "description": "Professional taxi service covering all major routes in North Bengal and Sikkim",
        "provider": {
            "@type": "Organization",
            "name": "Darjeeling Cab"
        },
        "areaServed": [
            "Darjeeling",
            "NJP",
            "Bagdogra", 
            "Siliguri",
            "Gangtok",
            "Kalimpong"
        ],
        "offers": [
            {
                "@type": "Offer",
                "name": "Darjeeling to NJP Taxi",
                "price": "1800",
                "priceCurrency": "INR",
                "url": "{{ url('/darjeeling-to-njp') }}"
            },
            {
                "@type": "Offer", 
                "name": "Bagdogra to Darjeeling Taxi",
                "price": "1600",
                "priceCurrency": "INR",
                "url": "{{ url('/bagdogra-to-darjeeling') }}"
            }
        ]
    }
    </script>
@endsection
