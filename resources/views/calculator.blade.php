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

        /* Autocomplete Styles */
        .autocomplete-wrapper {
            position: relative;
        }

        .autocomplete-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 0 0 8px 8px;
            max-height: 250px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
        }

        .autocomplete-results.show {
            display: block;
        }

        .autocomplete-option {
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.2s;
            border-bottom: 1px solid #f0f0f0;
        }

        .autocomplete-option:last-child {
            border-bottom: none;
        }

        .autocomplete-option:hover,
        .autocomplete-option.focused {
            background-color: var(--brand-light);
            color: var(--brand-color);
        }

        .autocomplete-option i {
            margin-right: 8px;
            color: var(--brand-color);
            opacity: 0.7;
        }

        /* Itinerary Day Card Styles */
        .day-card {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .day-card:hover {
            border-color: var(--brand-color);
            box-shadow: 0 4px 12px rgba(44, 90, 160, 0.1);
        }

        .day-card .day-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--brand-light);
        }

        .day-card .day-title {
            font-weight: 600;
            color: var(--brand-color);
            font-size: 1.1rem;
        }

        .day-card .btn-remove {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }

        .tour-summary {
            background: linear-gradient(135deg, var(--brand-color) 0%, var(--brand-dark) 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .tour-summary h5 {
            color: white;
            margin-bottom: 1rem;
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
                    <!-- Package Type Selection -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-suitcase text-brand me-2"></i>Package Type
                            </label>
                            <select class="form-select" id="packageType" required>
                                <option value="oneday">One Day Trip</option>
                                <option value="multiday">Tour Package (Multiple Days)</option>
                            </select>
                        </div>
                    </div>

                    <!-- One Day Trip Section -->
                    <div id="oneDaySection">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-map-marker-alt text-brand me-2"></i>From
                                </label>
                                <div class="autocomplete-wrapper">
                                    <input type="text" class="form-control" id="fromLocation"
                                        placeholder="Select or type pickup location" autocomplete="off">
                                    <div class="autocomplete-results" id="fromLocationResults"></div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-flag-checkered text-brand me-2"></i>To
                                </label>
                                <div class="autocomplete-wrapper">
                                    <input type="text" class="form-control" id="toLocation"
                                        placeholder="Select or type destination" autocomplete="off">
                                    <div class="autocomplete-results" id="toLocationResults"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar text-brand me-2"></i>Travel Date
                                </label>
                                <input type="date" class="form-control" id="travelDate">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-route text-brand me-2"></i>Trip Type
                                </label>
                                <select class="form-select" id="tripType">
                                    <option value="oneway">One Way</option>
                                    <option value="roundtrip">Round Trip</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Multi-Day Tour Section -->
                    <div id="multiDaySection" style="display: none;">
                        <p class="text-muted" id="tripTypeText">Multi-Day Trip</p>
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt text-brand me-2"></i>Start Date
                                </label>
                                <input type="date" class="form-control" id="startDate">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="fas fa-calendar-check text-brand me-2"></i>End Date
                                </label>
                                <input type="date" class="form-control" id="endDate">
                            </div>
                        </div>

                        <!-- Itinerary Builder -->
                        <div id="itineraryContainer" class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0"><i class="fas fa-map-marked-alt text-brand me-2"></i>Daily Itinerary</h6>
                                <button type="button" class="btn btn-sm btn-brand" id="generateItinerary">
                                    <i class="fas fa-magic me-1"></i>Generate Days
                                </button>
                            </div>
                            <div id="dailyItinerary"></div>
                        </div>
                    </div>

                    <!-- Vehicle Selection (Common for both) -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-car text-brand me-2"></i>Select Vehicle Type
                        </label>
                        <select class="form-select" id="vehicleType" required>
                            <option value="" selected>Choose a vehicle</option>
                            <option value="sedan">Sedan (Swift Dzire, Etios)</option>
                            <option value="suv">SUV (Innova, Ertiga)</option>
                            <option value="tempo">Tempo Traveller (12-17 seater)</option>
                        </select>
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
                                        <span id="vehicleTypeDisplay" class="fw-bold">-</span>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <h6 class="text-brand">Trip Type</h6>
                                    <span id="timeCharges" class="fw-bold">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <h4>Total Fare</h4>
                        <div class="price-display" id="totalFare">₹0</div>
                        <p class="text-muted" id="tripTypeText">One-way trip</p>
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
            // --- GLOBAL DATA ---
            // Fare matrix with vehicle-specific rates
            const fareMatrix = {
                'njp-darjeeling': {
                    sedan: 2500,
                    suv: 3000,
                    tempo: 3750,
                    distance: 78,
                    time: '3 hours'
                },
                'bagdogra-darjeeling': {
                    sedan: 3000,
                    suv: 3600,
                    tempo: 4500,
                    distance: 95,
                    time: '3.5 hours'
                },
                'siliguri-darjeeling': {
                    sedan: 2800,
                    suv: 3360,
                    tempo: 4200,
                    distance: 85,
                    time: '3.2 hours'
                },
                'darjeeling-gangtok': {
                    sedan: 4500,
                    suv: 5400,
                    tempo: 6750,
                    distance: 98,
                    time: '4 hours'
                },
                'darjeeling-kalimpong': {
                    sedan: 1800,
                    suv: 2160,
                    tempo: 2700,
                    distance: 51,
                    time: '2 hours'
                },
                'njp-gangtok': {
                    sedan: 4000,
                    suv: 4800,
                    tempo: 6000,
                    distance: 124,
                    time: '4.5 hours'
                },
                'bagdogra-gangtok': {
                    sedan: 4200,
                    suv: 5040,
                    tempo: 6300,
                    distance: 135,
                    time: '5 hours'
                },
                'siliguri-gangtok': {
                    sedan: 3800,
                    suv: 4560,
                    tempo: 5700,
                    distance: 114,
                    time: '4.2 hours'
                },
                'darjeeling-kurseong': {
                    sedan: 800,
                    suv: 960,
                    tempo: 1200,
                    distance: 32,
                    time: '1.5 hours'
                },
                'darjeeling-mirik': {
                    sedan: 1200,
                    suv: 1440,
                    tempo: 1800,
                    distance: 49,
                    time: '2.5 hours'
                },
                'njp-kalimpong': {
                    sedan: 3200,
                    suv: 3840,
                    tempo: 4800,
                    distance: 89,
                    time: '3.5 hours'
                },
                'bagdogra-kalimpong': {
                    sedan: 3500,
                    suv: 4200,
                    tempo: 5250,
                    distance: 102,
                    time: '4 hours'
                },
                'gangtok-kalimpong': {
                    sedan: 2800,
                    suv: 3360,
                    tempo: 4200,
                    distance: 78,
                    time: '3 hours'
                },
                'kurseong-gangtok': {
                    sedan: 4200,
                    suv: 5040,
                    tempo: 6300,
                    distance: 112,
                    time: '4.5 hours'
                },
                'mirik-gangtok': {
                    sedan: 4800,
                    suv: 5760,
                    tempo: 7200,
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

            // Helper to get key by display name (used for fare matrix lookup)
            function getLocationKey(value) {
                // Check if value is already a key
                if (locationNames[value]) return value;

                // Check if value matches a display name
                return Object.keys(locationNames).find(key => locationNames[key] === value) || value;
            }

            // Helper to get display name by key (used for output display)
            function getLocationName(key) {
                return locationNames[key] || key;
            }


            // --- CALCULATE FARE FUNCTION ---
            function calculateFare() {
                const selectedPackage = document.getElementById('packageType').value;
                const vehicleSelect = document.getElementById('vehicleType');
                const selectedVehicle = vehicleSelect.value;
                const loadingDiv = document.querySelector('.loading');

                // Basic validation
                if (!selectedVehicle) {
                    alert('Please select a vehicle type.');
                    return;
                }

                loadingDiv.style.display = 'block';

                // Find or create result container
                let resultDiv = document.getElementById('result');
                if (!resultDiv) {
                    resultDiv = document.createElement('div');
                    resultDiv.id = 'result';
                    resultDiv.className = 'mt-4';
                    loadingDiv.after(resultDiv);
                }
                resultDiv.style.display = 'none';

                let finalFare = 0;
                let summaryHTML = '';

                if (selectedPackage === 'oneday') {
                    // --- ONE DAY TRIP LOGIC ---
                    const fromInput = document.getElementById('fromLocation');
                    const toInput = document.getElementById('toLocation');
                    const tripType = document.getElementById('tripType').value;

                    // CRITICAL: Get the location KEY for fare matrix lookup
                    const fromLocationKey = getLocationKey(fromInput.value);
                    const toLocationKey = getLocationKey(toInput.value);

                    if (!fromLocationKey || !toLocationKey) {
                        alert('Please select valid pickup and destination locations using the suggestions.');
                        loadingDiv.style.display = 'none';
                        return;
                    }

                    const routeKey = `${fromLocationKey}-${toLocationKey}`;
                    const reverseRouteKey = `${toLocationKey}-${fromLocationKey}`;
                    let fareData = fareMatrix[routeKey] || fareMatrix[reverseRouteKey];

                    // Fallback fare data (if route not found, use a generic high estimate)
                    if (!fareData) {
                        alert('Fare data for this route is not explicitly defined. Using estimated fare.');
                        fareData = {
                            sedan: 4000,
                            suv: 5000,
                            tempo: 7000,
                            distance: 200,
                            time: '7 hours'
                        };
                    }

                    const baseFare = fareData[selectedVehicle] || fareData.sedan || 4000;
                    const roundTripMultiplier = tripType === 'roundtrip' ? 2 : 1;

                    finalFare = Math.round(baseFare * roundTripMultiplier);

                    // Prepare Summary for One Day
                    const tripTypeText = tripType === 'roundtrip' ? 'Round Trip' : 'One-way Trip';
                    summaryHTML = `
                            <tr>
                                <td class="text-start">Route</td>
                                <td class="text-end">${getLocationName(fromLocationKey)} → ${getLocationName(toLocationKey)}</td>
                            </tr>
                            <tr>
                                <td class="text-start">Distance / Duration</td>
                                <td class="text-end">${fareData.distance} km / ${fareData.time}</td>
                            </tr>
                            <tr>
                                <td class="text-start">Base Vehicle Charge (${selectedVehicle.toUpperCase()})</td>
                                <td class="text-end">₹${baseFare.toLocaleString('en-IN')}</td>
                            </tr>
                            <tr>
                                <td class="text-start">Trip Type Multiplier</td>
                                <td class="text-end">${tripTypeText} (x${roundTripMultiplier})</td>
                            </tr>
                        `;
                    document.getElementById('tripTypeText').textContent = tripTypeText;

                } else if (selectedPackage === 'multiday') {
                    // --- MULTI-DAY TRIP LOGIC (Retained from previous step) ---
                    const start = document.getElementById('startDate').value;
                    const end = document.getElementById('endDate').value;
                    const dayElements = document.querySelectorAll('#dailyItinerary .itinerary-day');
                    const days = dayElements.length;

                    if (!start || !end || days === 0) {
                        alert('Please select valid Start/End dates and click "Generate Days" to build the itinerary.');
                        loadingDiv.style.display = 'none';
                        return;
                    }

                    // Check for empty itinerary fields (basic validation)
                    let itineraryValid = true;
                    dayElements.forEach(dayDiv => {
                        const source = dayDiv.querySelector('.day-source').value;
                        const destination = dayDiv.querySelector('.day-destination').value;
                        if (!source || !destination) {
                            itineraryValid = false;
                        }
                    });

                    if (!itineraryValid) {
                        alert('Please fill in all Source and Destination locations in the itinerary.');
                        loadingDiv.style.display = 'none';
                        return;
                    }


                    // Mock Multi-Day Fare Calculation:
                    // Daily Rate is calculated based on vehicle type assuming a 250km/day minimum charge.
                    const dailyBaseRate = {
                        'sedan': 1800, // Example Fixed Daily Minimum
                        'suv': 2500,
                        'tempo': 3500
                    };

                    const dailyFixedCharge = dailyBaseRate[selectedVehicle] || dailyBaseRate.sedan;

                    // Calculate total base cost
                    let totalBaseCost = days * dailyFixedCharge;

                    // Add a small tour management charge
                    const serviceCharge = 500;
                    finalFare = Math.round(totalBaseCost + serviceCharge);


                    // Prepare Itinerary Summary
                    let itineraryDetails = '';
                    dayElements.forEach((dayDiv, index) => {
                        const source = dayDiv.querySelector('.day-source').value;
                        const destination = dayDiv.querySelector('.day-destination').value;
                        // Safely extract date from card header
                        const dateMatch = dayDiv.querySelector('.card-header h6').textContent.match(/\((.*?)\)/);
                        const dateText = dateMatch ? dateMatch[1] : '';
                        itineraryDetails += `Day ${index + 1} (${dateText}): ${source} → ${destination}\n`;
                    });

                    summaryHTML = `
                    <tr>
                        <td class="text-start">Package Duration</td>
                        <td class="text-end"><strong>${days} Days</strong></td>
                    </tr>
                    <tr>
                        <td class="text-start">Vehicle Daily Rate (${selectedVehicle.toUpperCase()})</td>
                        <td class="text-end">₹${dailyFixedCharge.toLocaleString('en-IN')} / Day (250km/day minimum)</td>
                    </tr>
                    <tr>
                        <td class="text-start">Total Base Cost (${days} days)</td>
                        <td class="text-end">₹${totalBaseCost.toLocaleString('en-IN')}</td>
                    </tr>
                    <tr>
                        <td class="text-start" colspan="2"><strong>Detailed Itinerary:</strong></td>
                    </tr>
                    <tr>
                        <td class="text-start" colspan="2" style="white-space: pre-wrap; font-size: 0.9rem;">${itineraryDetails}</td>
                    </tr>
                `;
                    document.getElementById('tripTypeText').textContent = `Multi-Day Tour (${days} Days)`;
                }

                // --- Final Display Update (Shared) ---
                setTimeout(() => {
                    // Render the final result block (using the existing resultDiv)
                    resultDiv.innerHTML = `
                    <div class="card shadow-lg border-0 fare-result-card" style="display: block;">

                        <div class="card-header bg-brand text-white text-center">
                            <h4 class="mb-0"><i class="fas fa-calculator me-2"></i>Fare Estimate for ${document.getElementById('tripTypeText').textContent}</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless small mb-3">
                                <tbody>
                                    ${summaryHTML}
                                </tbody>
                            </table>
                            <hr>
                            <div class="text-center">
                                <h4 class="mb-2">Total Estimated Fare:</h4>
                                <h1 class="text-danger fw-bold mb-3">₹${finalFare.toLocaleString('en-IN')}</h1>
                                <p class="text-muted small">*Toll, Parking, and Inter-State Taxes are not included and must be paid extra.</p>
                                <a id="bookNowBtn" href="#" class="btn btn-lg btn-success w-100">
                                    <i class="fas fa-bolt me-2"></i>Book Now
                                </a>
                            </div>
                        </div>
                    </div>
                `;

                    // Update booking URL with calculated fare data
                    const bookingUrl = new URL('/booking', window.location.origin);
                    bookingUrl.searchParams.append('package', selectedPackage);
                    bookingUrl.searchParams.append('fare', finalFare);
                    bookingUrl.searchParams.append('vehicle', selectedVehicle);
                    if (selectedPackage === 'oneday') {
                        // Use display names for the final URL for readability
                        bookingUrl.searchParams.append('from', fromInput.value);
                        bookingUrl.searchParams.append('to', toInput.value);
                        bookingUrl.searchParams.append('tripType', document.getElementById('tripType').value);
                    } else {
                        bookingUrl.searchParams.append('startDate', document.getElementById('startDate').value);
                        bookingUrl.searchParams.append('endDate', document.getElementById('endDate').value);
                    }

                    document.getElementById('bookNowBtn').href = bookingUrl.toString();

                    loadingDiv.style.display = 'none';
                    resultDiv.style.display = 'block';
                    resultDiv.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                }, 1500);
            }

            // --- DOMContentLoaded Logic (Your Existing Logic with Fixes) ---
            document.addEventListener('DOMContentLoaded', function() {
                // --- 1. Element References ---
                const fareCalculator = document.getElementById('fareCalculator');
                const packageType = document.getElementById('packageType');
                const oneDaySection = document.getElementById('oneDaySection');
                const multiDaySection = document.getElementById('multiDaySection');
                const startDateInput = document.getElementById('startDate');
                const endDateInput = document.getElementById('endDate');
                const generateItineraryButton = document.getElementById('generateItinerary');
                const dailyItineraryContainer = document.getElementById('dailyItinerary');
                const travelDateInput = document.getElementById('travelDate');

                // Set minimum date to today for one-day trip
                travelDateInput.min = new Date().toISOString().split('T')[0];

                // --- 2. Core Logic: Toggle Sections ---
                function toggleSections() {
                    if (packageType.value === 'oneday') {
                        oneDaySection.style.display = 'block';
                        multiDaySection.style.display = 'none';
                    } else if (packageType.value === 'multiday') {
                        oneDaySection.style.display = 'none';
                        multiDaySection.style.display = 'block';
                    }
                }

                // Initialize and listen for changes
                toggleSections();
                packageType.addEventListener('change', toggleSections);

                // --- 3. Multi-Day Logic: Generate Itinerary Fields ---
                function generateItineraryFields() {
                    dailyItineraryContainer.innerHTML = '';
                    const start = new Date(startDateInput.value);
                    const end = new Date(endDateInput.value);

                    // Check for valid dates
                    if (isNaN(start) || isNaN(end) || start > end) {
                        dailyItineraryContainer.innerHTML =
                            '<p class="text-danger">Please select valid Start and End dates (End Date must be on or after Start Date).</p>';
                        return;
                    }

                    // Calculate number of days (inclusive)
                    const dayDuration = Math.round((end - start) / (1000 * 60 * 60 * 24)) + 1;

                    let currentDate = new Date(start);

                    // Use the pickup/drop-off locations from the one-day fields as initial suggestions
                    const initialFrom = document.getElementById('fromLocation').value || '';
                    const initialTo = document.getElementById('toLocation').value || '';


                    for (let i = 1; i <= dayDuration; i++) {
                        const dateStr = currentDate.toLocaleDateString('en-IN');

                        const dayDiv = document.createElement('div');
                        dayDiv.classList.add('card', 'mb-3', 'itinerary-day');

                        let sourcePlaceholder = `Start location for Day ${i}`;
                        let destPlaceholder = `End location for Day ${i}`;
                        let sourceValue = '';
                        let destValue = '';

                        // Pre-fill Day 1 Source and Last Day Destination
                        if (i === 1 && initialFrom) {
                            sourceValue = initialFrom;
                        }
                        if (i === dayDuration && initialTo) {
                            destValue = initialTo;
                        }

                        dayDiv.innerHTML = `
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Day ${i} (${dateStr})</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small">
                                        <i class="fas fa-dot-circle text-success me-2"></i>Source Location (Day ${i})
                                    </label>
                                    <input type="text" class="form-control day-source" 
                                           data-day="${i}" placeholder="${sourcePlaceholder}" value="${sourceValue}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold small">
                                        <i class="fas fa-flag-checkered text-danger me-2"></i>Destination Location (Day ${i})
                                    </label>
                                    <input type="text" class="form-control day-destination" 
                                           data-day="${i}" placeholder="${destPlaceholder}" value="${destValue}" required>
                                </div>
                            </div>
                        </div>
                    `;
                        dailyItineraryContainer.appendChild(dayDiv);

                        currentDate.setDate(currentDate.getDate() + 1);
                    }
                }

                // Event listener for itinerary generation
                generateItineraryButton.addEventListener('click', generateItineraryFields);

                // Prompt for regeneration if dates change
                startDateInput.addEventListener('change', () => {
                    dailyItineraryContainer.innerHTML =
                        '<p class="text-warning"><i class="fas fa-exclamation-triangle me-2"></i>Dates changed. Click <strong>Generate Days</strong> to update the itinerary.</p>';
                });
                endDateInput.addEventListener('change', () => {
                    dailyItineraryContainer.innerHTML =
                        '<p class="text-warning"><i class="fas fa-exclamation-triangle me-2"></i>Dates changed. Click <strong>Generate Days</strong> to update the itinerary.</p>';
                });

                // --- 4. Autocomplete Setup ---
                // Your Autocomplete logic is kept, but it now correctly references the global locationNames.
                function setupAutocomplete(inputId, resultsId) {
                    const input = document.getElementById(inputId);
                    const results = document.getElementById(resultsId);

                    if (!input || !results) {
                        console.error('Autocomplete elements not found:', inputId, resultsId);
                        return;
                    }

                    function renderOptions(filter = '') {
                        results.innerHTML = '';
                        const filterLower = filter.toLowerCase();
                        let hasMatches = false;

                        Object.entries(locationNames).forEach(([key, name]) => {
                            if (name.toLowerCase().includes(filterLower)) {
                                hasMatches = true;
                                const div = document.createElement('div');
                                div.className = 'autocomplete-option';
                                div.innerHTML = `<i class="fas fa-map-marker-alt"></i> ${name}`;
                                div.addEventListener('click', () => {
                                    input.value = name;
                                    input.dataset.value = key; // Store the key!
                                    results.classList.remove('show');
                                });
                                results.appendChild(div);
                            }
                        });

                        if (hasMatches) {
                            results.classList.add('show');
                        } else {
                            results.classList.remove('show');
                        }
                    }

                    input.addEventListener('input', function() {
                        const currentVal = this.value;
                        // Auto-update dataset.value if a full match is typed/pasted
                        const matchKey = Object.keys(locationNames).find(key => locationNames[key]
                            .toLowerCase() === currentVal.toLowerCase());
                        if (matchKey) {
                            this.dataset.value = matchKey;
                        } else {
                            delete this.dataset.value;
                        }

                        renderOptions(this.value);
                    });

                    input.addEventListener('focus', function() {
                        renderOptions(this.value);
                    });

                    document.addEventListener('click', function(e) {
                        if (!input.contains(e.target) && !results.contains(e.target)) {
                            results.classList.remove('show');
                        }
                    });
                }

                setupAutocomplete('fromLocation', 'fromLocationResults');
                setupAutocomplete('toLocation', 'toLocationResults');


                // --- 5. Form submission ---
                fareCalculator.addEventListener('submit', function(e) {
                    e.preventDefault();
                    calculateFare();
                });
            });
        </script>
    @endpush

@endsection
