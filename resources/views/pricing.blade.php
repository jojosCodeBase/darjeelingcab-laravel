@extends('layouts.main')
@section('title', 'Darjeeling Cab Pricing - Dynamic Rate Calculator')
@section('meta-tags')
    <meta name="description"
        content="Calculate exact taxi fares instantly from NJP, Bagdogra, Siliguri to Darjeeling, Gangtok, Kalimpong. Get transparent pricing with our dynamic cab fare calculator." />
    <meta name="keywords"
        content="cab fare calculator, Darjeeling taxi rates, NJP to Darjeeling fare calculator, dynamic pricing, instant cab booking" />
@endsection

@push('styles')
    <style>
        :root {
            --brand-color: #2c5aa0;
            --brand-light: #e8f2ff;
            --brand-dark: #1a3d73;
        }

        .calculator-container {
            background: linear-gradient(135deg, var(--brand-light) 0%, #ffffff 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }

        .form-control:focus {
            border-color: var(--brand-color);
            box-shadow: 0 0 0 0.2rem rgba(44, 90, 160, 0.25);
        }

        .result-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(10px);
            opacity: 0;
            transition: all 0.5s ease;
        }

        .result-card.show {
            transform: translateY(0);
            opacity: 1;
        }

        .price-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--brand-color);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .route-info {
            background: var(--brand-light);
            border-radius: 10px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .vehicle-option {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 1rem;
            margin: 0.5rem 0;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .vehicle-option:hover,
        .vehicle-option.selected {
            border-color: var(--brand-color);
            background-color: var(--brand-light);
        }
    </style>
@endpush

@section('content')
    <div class="container blogs-container">
        <div class="row my-5">
            <!-- Dynamic Calculator Section -->
            <div class="text-center mb-5">
                <h1 class="text-brand fw-bold">Cab Fare Calculator</h1>
                <p class="text-muted">Get instant, transparent pricing for your journey</p>
            </div>

            <div class="calculator-container">
                <form id="fareCalculator">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt text-brand me-2"></i>From
                            </label>
                            <select class="form-select" id="fromLocation" required>
                                <option value="">Select pickup location</option>
                                <option value="njp">NJP Railway Station</option>
                                <option value="bagdogra">Bagdogra Airport</option>
                                <option value="siliguri">Siliguri</option>
                                <option value="darjeeling">Darjeeling</option>
                                <option value="gangtok">Gangtok</option>
                                <option value="kalimpong">Kalimpong</option>
                                <option value="kurseong">Kurseong</option>
                                <option value="mirik">Mirik</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-flag-checkered text-brand me-2"></i>To
                            </label>
                            <select class="form-select" id="toLocation" required>
                                <option value="">Select destination</option>
                                <option value="njp">NJP Railway Station</option>
                                <option value="bagdogra">Bagdogra Airport</option>
                                <option value="siliguri">Siliguri</option>
                                <option value="darjeeling">Darjeeling</option>
                                <option value="gangtok">Gangtok</option>
                                <option value="kalimpong">Kalimpong</option>
                                <option value="kurseong">Kurseong</option>
                                <option value="mirik">Mirik</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-calendar text-brand me-2"></i>Travel Date
                            </label>
                            <input type="date" class="form-control" id="travelDate" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-clock text-brand me-2"></i>Time
                            </label>
                            <select class="form-select" id="travelTime">
                                <option value="day">Day Time (6 AM - 6 PM)</option>
                                <option value="night">Night Time (6 PM - 6 AM)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-car text-brand me-2"></i>Select Vehicle Type
                        </label>
                        <div class="row" id="vehicleOptions">
                            <div class="col-md-4">
                                <div class="vehicle-option" data-type="sedan" data-multiplier="1">
                                    <div class="text-center">
                                        <i class="fas fa-car fa-2x text-brand mb-2"></i>
                                        <h6>Sedan</h6>
                                        <small class="text-muted">Swift Dzire, Etios</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="vehicle-option selected" data-type="suv" data-multiplier="1.2">
                                    <div class="text-center">
                                        <i class="fas fa-truck fa-2x text-brand mb-2"></i>
                                        <h6>SUV</h6>
                                        <small class="text-muted">Innova, Ertiga</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="vehicle-option" data-type="tempo" data-multiplier="1.5">
                                    <div class="text-center">
                                        <i class="fas fa-bus fa-2x text-brand mb-2"></i>
                                        <h6>Tempo Traveller</h6>
                                        <small class="text-muted">12-17 seater</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-brand btn-lg px-5">
                            <i class="fas fa-calculator me-2"></i>Calculate Fare
                        </button>
                    </div>
                </form>

                <div class="loading text-center mt-4" style="display: none;">
                    <div class="spinner-border text-brand" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Calculating your fare...</p>
                </div>
            </div>

            <div id="result" class="result-card mt-4" style="display: none;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="route-info">
                            <h5 id="routeDisplay" class="mb-0"></h5>
                            <p id="distanceTime" class="text-muted mb-0"></p>
                        </div>

                        <div class="fare-breakdown">
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="border-end">
                                        <h6 class="text-brand">Base Fare</h6>
                                        <span id="baseFare" class="fw-bold">₹0</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border-end">
                                        <h6 class="text-brand">Vehicle Type</h6>
                                        <span id="vehicleType" class="fw-bold">-</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <h6 class="text-brand">Time Charges</h6>
                                    <span id="timeCharges" class="fw-bold">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <h4>Total Fare</h4>
                        <div class="price-display" id="totalFare">₹0</div>
                        <p class="text-muted">One-way trip</p>
                        <a href="{{ route('booking') }}" class="btn btn-brand w-100 mt-3" id="bookNowBtn">
                            <i class="fas fa-phone me-2"></i>Book Now
                        </a>
                    </div>
                </div>

                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Note:</strong> This is an estimated fare. Final price may vary based on actual route conditions,
                    waiting time, and seasonal factors.
                </div>
            </div>

            <!-- Original Static Cards (as fallback/examples) -->
            <div class="row mt-5">
                <div class="text-center mb-4">
                    <h3 class="text-brand fw-bold">Popular Routes</h3>
                    <p class="text-muted">Quick booking for frequently traveled destinations</p>
                </div>

                <div class="row g-4">
                    <!-- Keep your existing cards here -->
                    <div class="col-md-4">
                        <div class="card shadow-lg border-0 h-100">
                            <div class="card-header bg-brand text-white text-center">
                                <h5 class="mb-0 text-light">NJP → Darjeeling</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="text-brand">₹ 2,500</h3>
                                <p class="text-muted">One-way trip</p>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>✔ Sedan / SUV Available</li>
                                    <li>✔ AC Cab</li>
                                    <li>✔ Includes Driver Allowance</li>
                                    <li>✔ Pickup from NJP Station</li>
                                </ul>
                                <a href="{{ route('booking') }}" class="btn btn-brand w-100">Book Now</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-4">
                        <div class="card shadow-lg border-0 h-100">
                            <div class="card-header bg-brand text-white text-center">
                                <h5 class="mb-0 text-light">Bagdogra → Darjeeling</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="text-brand">₹ 3,000</h3>
                                <p class="text-muted">One-way trip</p>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>✔ Sedan / SUV Available</li>
                                    <li>✔ AC Cab</li>
                                    <li>✔ Luggage Assistance</li>
                                    <li>✔ Airport Pickup</li>
                                </ul>
                                <a href="{{ route('booking') }}" class="btn btn-brand w-100">Book Now</a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-4">
                        <div class="card shadow-lg border-0 h-100">
                            <div class="card-header bg-brand text-white text-center">
                                <h5 class="mb-0 text-light">Darjeeling → Gangtok</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="text-brand">₹ 4,500</h3>
                                <p class="text-muted">One-way trip</p>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>✔ Sedan / SUV Available</li>
                                    <li>✔ Scenic Route</li>
                                    <li>✔ Experienced Driver</li>
                                    <li>✔ Doorstep Pickup</li>
                                </ul>
                                <a href="{{ route('booking') }}" class="btn btn-brand w-100">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Note Section -->
            <div class="alert alert-info mt-5">
                <strong>Note:</strong> Prices may vary slightly depending on vehicle type, season, and availability. Contact
                us for customized tour packages or multi-day bookings.
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Fare matrix with base rates
            const fareMatrix = {
                'njp-darjeeling': {
                    base: 2500,
                    distance: 78,
                    time: '3 hours'
                },
                'bagdogra-darjeeling': {
                    base: 3000,
                    distance: 95,
                    time: '3.5 hours'
                },
                'siliguri-darjeeling': {
                    base: 2800,
                    distance: 85,
                    time: '3.2 hours'
                },
                'darjeeling-gangtok': {
                    base: 4500,
                    distance: 98,
                    time: '4 hours'
                },
                'darjeeling-kalimpong': {
                    base: 1800,
                    distance: 51,
                    time: '2 hours'
                },
                'njp-gangtok': {
                    base: 4000,
                    distance: 124,
                    time: '4.5 hours'
                },
                'bagdogra-gangtok': {
                    base: 4200,
                    distance: 135,
                    time: '5 hours'
                },
                'siliguri-gangtok': {
                    base: 3800,
                    distance: 114,
                    time: '4.2 hours'
                },
                'darjeeling-kurseong': {
                    base: 800,
                    distance: 32,
                    time: '1.5 hours'
                },
                'darjeeling-mirik': {
                    base: 1200,
                    distance: 49,
                    time: '2.5 hours'
                },
                'njp-kalimpong': {
                    base: 3200,
                    distance: 89,
                    time: '3.5 hours'
                },
                'bagdogra-kalimpong': {
                    base: 3500,
                    distance: 102,
                    time: '4 hours'
                },
                'gangtok-kalimpong': {
                    base: 2800,
                    distance: 78,
                    time: '3 hours'
                },
                'kurseong-gangtok': {
                    base: 4200,
                    distance: 112,
                    time: '4.5 hours'
                },
                'mirik-gangtok': {
                    base: 4800,
                    distance: 135,
                    time: '5.5 hours'
                }
            };

            const locationNames = {
                'njp': 'NJP Railway Station',
                'bagdogra': 'Bagdogra Airport',
                'siliguri': 'Siliguri',
                'darjeeling': 'Darjeeling',
                'gangtok': 'Gangtok',
                'kalimpong': 'Kalimpong',
                'kurseong': 'Kurseong',
                'mirik': 'Mirik'
            };

            document.addEventListener('DOMContentLoaded', function() {
                // Set minimum date to today
                document.getElementById('travelDate').min = new Date().toISOString().split('T')[0];

                // Vehicle selection
                document.querySelectorAll('.vehicle-option').forEach(option => {
                    option.addEventListener('click', function() {
                        document.querySelectorAll('.vehicle-option').forEach(opt => opt.classList
                            .remove('selected'));
                        this.classList.add('selected');
                    });
                });

                // Form submission
                document.getElementById('fareCalculator').addEventListener('submit', function(e) {
                    e.preventDefault();
                    calculateFare();
                });

                // Dynamic location filtering
                document.getElementById('fromLocation').addEventListener('change', function() {
                    const selectedFrom = this.value;
                    const toSelect = document.getElementById('toLocation');

                    Array.from(toSelect.options).forEach(option => {
                        option.style.display = option.value === selectedFrom ? 'none' : 'block';
                    });
                });

                document.getElementById('toLocation').addEventListener('change', function() {
                    const selectedTo = this.value;
                    const fromSelect = document.getElementById('fromLocation');

                    Array.from(fromSelect.options).forEach(option => {
                        option.style.display = option.value === selectedTo ? 'none' : 'block';
                    });
                });
            });

            function calculateFare() {
                const fromLocation = document.getElementById('fromLocation').value;
                const toLocation = document.getElementById('toLocation').value;
                const travelTime = document.getElementById('travelTime').value;
                const selectedVehicle = document.querySelector('.vehicle-option.selected');

                if (!fromLocation || !toLocation) {
                    alert('Please select both pickup and destination locations.');
                    return;
                }

                if (fromLocation === toLocation) {
                    alert('Pickup and destination cannot be the same.');
                    return;
                }

                // Show loading
                document.querySelector('.loading').style.display = 'block';
                document.getElementById('result').style.display = 'none';

                // Simulate API call delay for better UX
                setTimeout(() => {
                    const routeKey = `${fromLocation}-${toLocation}`;
                    const reverseRouteKey = `${toLocation}-${fromLocation}`;

                    let fareData = fareMatrix[routeKey] || fareMatrix[reverseRouteKey];

                    // If route not in matrix, calculate estimated fare
                    if (!fareData) {
                        fareData = {
                            base: 2000,
                            distance: 75,
                            time: '3 hours'
                        };
                    }

                    const baseFare = fareData.base;
                    const vehicleMultiplier = parseFloat(selectedVehicle.dataset.multiplier);
                    const nightChargeMultiplier = travelTime === 'night' ? 1.2 : 1;

                    const finalFare = Math.round(baseFare * vehicleMultiplier * nightChargeMultiplier);

                    // Update result display
                    document.getElementById('routeDisplay').textContent =
                        `${locationNames[fromLocation]} → ${locationNames[toLocation]}`;
                    document.getElementById('distanceTime').textContent =
                        `Distance: ${fareData.distance} km • Duration: ${fareData.time}`;
                    document.getElementById('baseFare').textContent = `₹${baseFare}`;
                    document.getElementById('vehicleType').textContent = selectedVehicle.dataset.type.toUpperCase();
                    document.getElementById('timeCharges').textContent = travelTime === 'night' ? '+20%' : 'Day Rate';
                    document.getElementById('totalFare').textContent = `₹${finalFare}`;

                    // Update booking URL with calculated fare data
                    const bookingUrl = new URL('{{ route('booking') }}', window.location.origin);
                    bookingUrl.searchParams.append('from', fromLocation);
                    bookingUrl.searchParams.append('to', toLocation);
                    bookingUrl.searchParams.append('fare', finalFare);
                    bookingUrl.searchParams.append('vehicle', selectedVehicle.dataset.type);
                    document.getElementById('bookNowBtn').href = bookingUrl.toString();

                    // Hide loading and show result
                    document.querySelector('.loading').style.display = 'none';
                    document.getElementById('result').style.display = 'block';
                    document.getElementById('result').classList.add('show');

                    // Smooth scroll to result
                    document.getElementById('result').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Track engagement (Google Analytics or similar)
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'fare_calculated', {
                            'event_category': 'engagement',
                            'event_label': `${fromLocation}-${toLocation}`,
                            'value': finalFare
                        });
                    }
                }, 1500);
            }
        </script>
    @endpush
@endsection
